<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function register(){
        return view('pages/register');
    }
    public function login(){
        return view('pages/login');
    }
    public function passwordForgot(){
        return view('pages/password_forgot');
    }
    public function passwordResetPin(){
        return view('pages/password_reset_pin');
    }
    public function changePassword(){
        return view('pages/password_change');
    }

}
