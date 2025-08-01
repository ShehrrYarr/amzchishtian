<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pettyCash;


class PettyCashController extends Controller
{
    public function store(Request $request)
{
    $data = $request->validate([
        'date' => 'required|date',
        'amount' => 'required|numeric|min:0.01',
        'type' => 'required|in:in,out',
        'description' => 'nullable|string|max:255',
    ]);

    $data['user_id'] = auth()->id();

    PettyCash::create($data);

    return redirect()->back()->with('success', 'Petty cash entry added!');
}

public function index()
{
    $pettyCashes = PettyCash::with('user')->orderByDesc('date')->get();

    // Optionally, show sum of in/out
    $totalIn = $pettyCashes->where('type', 'in')->sum('amount');
    $totalOut = $pettyCashes->where('type', 'out')->sum('amount');
    $balance = $totalIn - $totalOut;

    return view('pettycash.index', compact('pettyCashes', 'totalIn', 'totalOut', 'balance'));
}
}
