<?php

namespace App\Http\Controllers;

use App\Models\MasterPassword;
use Illuminate\Http\Request;

class MasterPasswordController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showPassword()
{
    if (auth()->user()->id == 1) {
        $masterPassword = MasterPassword::first();
        return view('showPassword', compact('masterPassword'));
    } else {
        return redirect()->route('homeRoute')->with('danger', 'You do not have the permission to enter this page.');
    }
}

public function updatePassword(Request $request)
{
    $request->validate([
        'update_password' => 'nullable|string|max:255',
        'delete_password' => 'nullable|string|max:255',
        'approve_password' => 'nullable|string|max:255',
    ]);

    $masterPassword = MasterPassword::first();

    if (!$masterPassword) {
        return redirect()->back()->with('danger', 'Master Password record not found.');
    }

    // Update only if fields are filled
    if ($request->filled('update_password')) {
        $masterPassword->update_password = $request->input('update_password');
    }

    if ($request->filled('delete_password')) {
        $masterPassword->delete_password = $request->input('delete_password');
    }

    if ($request->filled('approve_password')) {
        $masterPassword->approve_password = $request->input('approve_password');
    }

    $masterPassword->updated_at = now();
    $masterPassword->save();

    return redirect()->back()->with('success', 'Passwords updated successfully.');
}


}
