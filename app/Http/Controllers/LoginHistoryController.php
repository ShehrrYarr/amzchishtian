<?php

namespace App\Http\Controllers;

use App\Models\LoginHistory;
use Illuminate\Http\Request;

class LoginHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAllLogins(){
        $LoginHistories = LoginHistory::get();
        return view('loginHistory',compact('LoginHistories'));
    }
}
