<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(){
        return view('loginpage.login');
    }
    public function home(){
        return view('home', ['name' => 'Anees', 'age' => '23']);
    }
}
