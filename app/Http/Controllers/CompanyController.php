<?php

namespace App\Http\Controllers;

use App\Models\company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
     public function __construct()
     {
         $this->middleware('auth');
     }
    public function showCompanies()
    {
        $company = company::all();
        return view('showCompanies', compact('company'));
    }

     public function storeCompany(Request $request)
{
    // dd($request);
    $validated = $request->validate([
        'name' => 'required|string|max:255',
    ]);

    if (company::where('name', $validated['name'])->exists()) {
        return redirect()->back()->withInput()->withErrors([
            'name' => 'Company with this name already exists.',
        ]);
    }

    company::create([
        'name' => $validated['name'],
    ]);

    return redirect()->back()->with('success', 'Company added successfully!');
}


public function editCompany($id)
    {
        $filterId = company::find($id);
        // dd($filterId);
        if (!$filterId) {

            return response()->json(['message' => 'Id not found'], 404);
        }

        return response()->json(['result' => $filterId]);

    }


     public function updateCompany(Request $request)
{
    $data = company::findOrFail($request->id);
    $data->name = $request->input('name');

    $data->save();

    return redirect()->back()->with('success', 'Company updated successfully.');
}


public function destroyCompany(Request $request){

   $company = company::findOrFail($request->id);
    $company->delete();

    return redirect()->back()->with('success', 'Company deleted successfully!');

}


}
