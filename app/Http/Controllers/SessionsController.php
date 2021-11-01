<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    //
    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Goodbye!');
    }

    public function login()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(auth()->attempt($attributes)){
            $userRole = Auth::user()->role;
            if($userRole == 'admin'){
                return redirect('/admin')->with('success','Welcome Admin!');
            }else if($userRole == 'contact'){
                return redirect('/contact')->with('success','Welcome Contact!');
            }else{
                auth()->logout();
                return redirect('/')->with('success', 'Goodbye!');
            }
        }
        return back()->withErrors(['email' => 'Your provided credentials could not be verified']);
    }
}
