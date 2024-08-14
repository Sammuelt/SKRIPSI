<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;

class SesiController extends Controller
{
    function index()
    {
       return view('pages.login');
    }
    function login(Request $request){
        $request->validate([
            'email'=> 'required',
            'password'=>'required'
        ],[
            'email.required'=>'Email wajib diisi',
            'passwoed.required'=>'Password wajib diisi',
        ]);
    }
}
