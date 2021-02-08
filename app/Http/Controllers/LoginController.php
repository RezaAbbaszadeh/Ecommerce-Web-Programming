<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware(['guest','throttle:5,1']);
    }

    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {

        // if ($this->hasTooManyLoginAttempts($request)) {
        //     $this->fireLockoutEvent($request);
        //     return $this->sendLockoutResponse($request);
        // }
        // $this->incrementLoginAttempts($request);
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(!auth()->attempt($request->only('email', 'password'), $request->remember)){
            return back()->with('status', 'Invalid login details');
        }
        else{

        }
        // $this->clearLoginAttempts($request);
        if(auth()->user()->isCustomer)
            return redirect()->route('home');
        else
            return redirect()->route('home.sellers');
    }
}
