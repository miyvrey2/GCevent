<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;

class ActivateController extends Controller
{


    /**
     * Display the validate message
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::logout();
        return view('auth.activate');
    }
}
