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

    public function index()
    {
        return view('auth.register',[
            'captcha' => $this->createCaptcha()
        ]);
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
            'password_confirmation' => 'min:4',
            'captcha' => 'required|in:'.session('captcha')
        ],[
            'captcha.in' => 'Wrong captcha! Try again.'
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
        return view('auth.register_seller',[
            'captcha' => $this->createCaptcha()
        ]);
    }

    public function storeSeller(Request $request){
        $this->validate($request,[
            'name' => 'required|max:255',
            'owner' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone_number' => 'required|min:1|max:11|regex:/^[0-9]+$/',
            'address' => 'required|max:255',
            'password' => 'required|min:4|confirmed',
            'password_confirmation' => 'min:4',
            'captcha' => 'required|in:'.session('captcha')
        ],[
            'captcha.in' => 'Wrong captcha! Try again.'
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

    public function createCaptcha()
    {
        $firstNum = $secondNum = $result = 0;
        $operation = rand(0, 4);
        if ($operation == 0) { // +
            $firstNum = rand(10, 100);
            $secondNum = rand(10, 100);
            $result = $firstNum + $secondNum;
            $captcha = "" . $firstNum . " + " . $secondNum . " = ";
        } else if ($operation == 1) { // -
            $firstNum = rand(10, 100);
            $secondNum = rand(10, 100);
            $result = $firstNum - $secondNum;
            $captcha = "" . $firstNum . " - " . $secondNum . " = ";
        } else if ($operation == 2) { // /
            $secondNum = rand(2, 10);
            $result = rand(3, 15);
            $firstNum = $secondNum * $result;
            $captcha = "" . $firstNum . " / " . $secondNum . " = ";
        } else if ($operation == 3) { // %
            $secondNum = rand(2, 12);
            $firstNum = rand($secondNum, 100);
            $result = $firstNum % $secondNum;
            $captcha = "" . $firstNum . " % " . $secondNum . " = ";
        } else if ($operation == 4) { // *
            $firstNum = rand(0, 20);
            $secondNum = rand(0, 20);
            $result = $firstNum * $secondNum;
            $captcha = "" . $firstNum . " * " . $secondNum . " = ";
        }
        session(['captcha' => (string)$result]);
        return $captcha;
    }
}
