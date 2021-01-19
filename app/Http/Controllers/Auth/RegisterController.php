<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:4|confirmed',
            'password_confirmation' => 'min:4'
        ]);

        $profile = Customer::create([]);
        $profile->user()->save(
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ])
        );
        
        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('home');
    }


    public function indexSeller()
    {
        return view('auth.register_seller');
    }

    public function storeSeller(Request $request){
        $this->validate($request,[
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:4|confirmed',
            'password_confirmation' => 'min:4'
        ]);

        $profile = Seller::create([]);
        $profile->user()->save(
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ])
        );
        
        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('home.sellers');
    }
}
