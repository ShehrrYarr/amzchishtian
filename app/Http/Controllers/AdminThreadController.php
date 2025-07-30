<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserThread;
use Illuminate\Support\Facades\Auth;

class AdminThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chatUsers = UserThread::with('users')
            ->select('user_id')
            ->groupBy('user_id')
            ->get();
        $messages = UserThread::where('user_id', Auth::user()->id)
            ->get();
        return view('admin_thread', compact('messages', 'chatUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function fetchThread($user_id)
    {
        $messages = UserThread::with("users")
            ->where('user_id', $user_id)
            ->orderBy('created_at')
            ->get();
 
        return response()->json($messages);
    }
}
