<?php

namespace App\Http\Controllers;

use App\Models\UserThread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = UserThread::where('user_id', Auth::user()->id)
            ->get();
        return view('user_thread', compact('messages'));
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
    public function store($message, $chat_id)
    { 
        $is_admin = 0;
        $user_id = 0;
        if(Auth::user()->is_admin == 1)
        {
            $is_admin = 1;
            $user_id = $chat_id;
        }
        else if(Auth::user()->is_admin == 0)
        {
            $user_id = Auth::user()->id;
        }
        $createThread = UserThread::create([
            'message' => urldecode($message),
            'user_id' => $user_id,
            'is_read' => false,
            'is_from_admin' => $is_admin
        ]); 
        return response()->json($createThread);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserThread  $userThread
     * @return \Illuminate\Http\Response
     */
    public function show(UserThread $userThread)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserThread  $userThread
     * @return \Illuminate\Http\Response
     */
    public function edit(UserThread $userThread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserThread  $userThread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserThread $userThread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserThread  $userThread
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserThread $userThread)
    {
        //
    } 
}
