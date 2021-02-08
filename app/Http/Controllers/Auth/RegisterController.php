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
        $this->middleware(['guest', 'throttle:5,1']);
    }

    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'birthday'  => 'required|date_format:Y-m-d|before:today',
            'national_id' => 'required|min:1|max:10|regex:/^[0-9]+$/',
            'phone_number' => 'required|min:1|max:11|regex:/^[0-9]+$/',
            'address' => 'required|max:255',
            'password' => 'required|min:4|confirmed',
            'password_confirmation' => 'min:4'
        ]);

        $profile = Customer::create(["birthday"=>$request->birthday, "national_id"=>$request->national_id]);
        $profile->user()->save(
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
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
            'owner' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone_number' => 'required|min:1|max:11|regex:/^[0-9]+$/',
            'address' => 'required|max:255',
            'password' => 'required|min:4|confirmed',
            'password_confirmation' => 'min:4'
        ]);

        $profile = Seller::create(["owner_name"=>$request->owner]);
        $profile->user()->save(
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'password' => Hash::make($request->password),
            ])
        );
        
        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('home.sellers');
    }
}
