<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccessoryBatch;
use App\Models\company;
use App\Models\Group;
use App\Models\MasterPassword;
use App\Models\vendor;
use App\Models\Accessory;
use App\Models\Accounts;



class AccessoryBatchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       
        $vendors = vendor::all();
        $accessories = Accessory::all();

        
        $batches = AccessoryBatch::with(['accessory','user','vendor'])->get();
        return view('batches.index', compact('batches','vendors','accessories'));
    }

    // public function store(Request $request)
    // {
    //     // dd($request->all());
    //     try {
    //         $validated = $request->validate([
    //             'accessory_id'    => 'required|exists:accessories,id',
    //             'vendor_id'       => 'required|exists:vendors,id',
    //             'qty_purchased'   => 'required|integer|min:1',
    //             'purchase_price'  => 'required|numeric|min:0',
    //             'purchase_date'   => 'required|date',
    //         ]);
    //         $validated['user_id'] = auth()->id(); 
    //         $validated['qty_remaining'] = $validated['qty_purchased'];
    
    //         // Generate a unique barcode, e.g.,
    //         $lastId = \App\Models\AccessoryBatch::max('id') ?? 0;
    //         $validated['barcode'] = str_pad($lastId + 1, 5, '0', STR_PAD_LEFT);
    
    //         \App\Models\AccessoryBatch::create($validated);
    
    //         return redirect()->back()->with('success', 'Batch Added Successfully.');
    
    //     } catch (\Illuminate\Validation\ValidationException $e) {
    //         // Laravel will redirect back with validation errors automatically.
    //         throw $e;
    //     } catch (\Exception $e) {
    //         // Log the error for debugging
    //         \Log::error('Batch creation failed: ' . $e->getMessage());
    
    //         return redirect()->back()
    //             ->withInput()
    //             ->with('danger', 'An unexpected error occurred while adding the batch. Please try again.');
    //     }
    // }

    public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'accessory_id'    => 'required|exists:accessories,id',
            'vendor_id'       => 'required|exists:vendors,id',
            'qty_purchased'   => 'required|integer|min:1',
            'purchase_price'  => 'required|numeric|min:0',
            'selling_price'  => 'required|numeric|min:0',
            'purchase_date'   => 'required|date',
        'description' => 'nullable|string',

           
        ]);
        $validated['user_id'] = auth()->id();
        $validated['qty_remaining'] = $validated['qty_purchased'];

        // Generate a unique barcode
        $lastId = \App\Models\AccessoryBatch::max('id') ?? 0;
        $validated['barcode'] = str_pad($lastId + 1, 5, '0', STR_PAD_LEFT);

        $batch = \App\Models\AccessoryBatch::create($validated);

        // Accounts logic
        $totalAmount = $validated['qty_purchased'] * $validated['purchase_price'];
        $payAmount = $request->input('pay_amount', 0);

        // Credit: you owe the vendor for the batch
        \App\Models\Accounts::create([
            'vendor_id'   => $validated['vendor_id'],
            'Credit'      => $totalAmount,
            'Debit'       => 0,
            'description' => "Batch Purchase: {$batch->barcode} ({$validated['qty_purchased']} x {$validated['purchase_price']})",
            'created_by'  => auth()->id(),
        ]);

        // Debit: if you paid any amount now
        if ($payAmount > 0) {
            sleep(1);
            \App\Models\Accounts::create([
                'vendor_id'   => $validated['vendor_id'],
                'Credit'      => 0,
                'Debit'       => $payAmount,
                'description' => "Payment for Batch: {$batch->barcode}",
                'created_by'  => auth()->id(),
            ]);
        }

        return redirect()->back()->with('success', 'Batch Added Successfully.');

    } catch (\Illuminate\Validation\ValidationException $e) {
        throw $e;
    } catch (\Exception $e) {
        \Log::error('Batch creation failed: ' . $e->getMessage());
        return redirect()->back()
            ->withInput()
            ->with('danger', 'An unexpected error occurred while adding the batch. Please try again.');
    }
}



    public function barcodeInfo($id)
{
    $batch = \App\Models\AccessoryBatch::with(['accessory', 'user','vendor'])->findOrFail($id);

    return response()->json([
        'success'     => true,
        'batch'       => [
            'barcode'       => $batch->barcode,
            'accessory'     => $batch->accessory->name ?? '',
            'vendor'        => $batch->vendor->name ?? '',
            'qty_purchased' => $batch->qty_purchased,
            'qty_remaining' => $batch->qty_remaining,
            'purchase_price'=> $batch->purchase_price,
            'selling_price'=> $batch->selling_price,
            'purchase_date' => $batch->purchase_date,
            // You can add more fields if needed
        ],
        // This will generate a SVG barcode as HTML string
        'barcode_html' => \DNS1D::getBarcodeHTML($batch->barcode, 'C128'),
    ]);
}

    


  
}
