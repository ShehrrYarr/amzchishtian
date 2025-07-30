<?php

namespace App\Http\Controllers;

use App\Models\Accounts;

use App\Models\TransferRecord;
use Hash;
use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Accessory;
use App\Models\AccessoryBatch;
use App\Models\SaleItem;

class UserController extends Controller
{

    public function index()
    {
        $userId = auth()->id();

        $totalAccessoryCount = AccessoryBatch::sum('qty_remaining');

        $totalSoldAccessories = SaleItem::sum('quantity');

       

            $totalAccessoryAmount = \App\Models\Accessory::with('batches')
            ->get()
            ->reduce(function($carry, $accessory) {
                // Sum qty_remaining * purchase_price for all batches of this accessory
                $amount = $accessory->batches->sum(function($batch) {
                    return $batch->qty_remaining * $batch->purchase_price;
                });
                return $carry + $amount;
            }, 0);

        $totalSoldAmount = SaleItem::sum('subtotal');
    


        // 7. Weekly Profit (Friday to Friday)
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::FRIDAY);
        $endOfWeek = Carbon::now()->endOfWeek(Carbon::FRIDAY);

     
       

        //Total Receivable from Vendors (sum of DB - CR where balance > 0)
        $vendorReceivables = DB::table('accounts')
        ->select(
            'vendor_id',
            DB::raw("SUM(Debit) AS total_debit"),
            DB::raw("SUM(Credit) AS total_credit")
        )
        ->whereNotNull('vendor_id')
        ->groupBy('vendor_id')
        ->get();
    
    $totalReceivable = $vendorReceivables->reduce(function ($carry, $vendor) {
        $balance = $vendor->total_debit - $vendor->total_credit;
        return $balance > 0 ? $carry + $balance : $carry;
    }, 0);

        $lowStockAccessories = Accessory::with('batches')->get()->filter(function($accessory) {
            $totalStock = $accessory->batches->sum('qty_remaining');
            return $totalStock < $accessory->min_qty;
        })->map(function($accessory) {
            return [
                'name' => $accessory->name,
                'min_qty' => $accessory->min_qty,
                'stock' => $accessory->batches->sum('qty_remaining'),
            ];
        })->values();

$totalApprovedSales = \App\Models\Sale::where('status', 'approved')->sum('total_amount');
$totalPendingSales = \App\Models\Sale::where('status', 'pending')->sum('total_amount');
$totalApprovedSalesCount = \App\Models\Sale::where('status', 'approved')->count();
$totalPendingSalesCount = \App\Models\Sale::where('status', 'pending')->count();

        return view('user_dashboard', compact(
            'totalAccessoryCount',
            'totalSoldAccessories',
            'totalSoldAmount',
            'totalReceivable',
            'userId','lowStockAccessories','totalAccessoryAmount'  , 'totalApprovedSales',
    'totalPendingSales','totalApprovedSalesCount','totalPendingSalesCount'
        ));
    }

    public function showUsers()
    {
        if (!in_array(auth()->id(), [1, 2])) {
            return redirect()->back()->with('danger', 'You cannot view this page.');
        }

        $users = User::all();

        return view('showUsers', compact('users'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'password_text' => $request->password,
        ]);

        return redirect()->back()->with('success', 'User added successfully.');
    }

    public function editUser($id)
    {
        $filterId = User::find($id);
        // dd($filterId);
        if (!$filterId) {

            return response()->json(['message' => 'Id not found'], 404);
        }

        return response()->json(['result' => $filterId]);

    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $request->id,
            'password' => 'nullable|string|min:6', // Make password optional for update
            'is_active' => 'nullable|boolean', // Validate the active status
        ]);

        $user = User::findOrFail($request->id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password, // Update password only if provided
            'password_text' => $request->password,
            'is_active' => $request->is_active, // Update the active status
        ]);

        return redirect()->back()->with('success', 'User updated successfully.');
    }


    public function logoutUser($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Manually logging out the specified user by clearing their session
        // We can store the user's session ID or other identifier to be able to clear the correct session later.

        $sessionKey = 'user_session_' . $user->id;

        // Clear the specific user's session
        Session::forget($sessionKey);  // Remove session data related to the user

        // Optionally, if you're storing the user session manually (e.g., in a cache), you would invalidate it here.

        return redirect()->route('home')->with('success', 'User has been logged out successfully.');
    }


}
