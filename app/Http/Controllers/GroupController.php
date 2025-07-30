<?php

namespace App\Http\Controllers;

use App\Models\group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
     public function __construct()
     {
         $this->middleware('auth');
     }
     public function showGroups()
    {
        $group = group::all();
        return view('showGroups', compact('group'));
    }

     public function storeGroup(Request $request)
{
    // dd($request);
    $validated = $request->validate([
        'name' => 'required|string|max:255',
    ]);

    if (group::where('name', $validated['name'])->exists()) {
        return redirect()->back()->withInput()->withErrors([
            'name' => 'Company with this name already exists.',
        ]);
    }

    group::create([
        'name' => $validated['name'],
    ]);

    return redirect()->back()->with('success', 'group added successfully!');
}


public function editGroup($id)
    {
        $filterId = group::find($id);
        // dd($filterId);
        if (!$filterId) {

            return response()->json(['message' => 'Id not found'], 404);
        }

        return response()->json(['result' => $filterId]);

    }


     public function updateGroup(Request $request)
{
    $data = group::findOrFail($request->id);
    $data->name = $request->input('name');

    $data->save();

    return redirect()->back()->with('success', 'Group updated successfully.');
}


public function destroyGroup(Request $request){

   $group = group::findOrFail($request->id);
    $group->delete();

    return redirect()->back()->with('success', 'Group deleted successfully!');

}
}
