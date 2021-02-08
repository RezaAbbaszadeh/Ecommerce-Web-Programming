<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{

    public function index()
    {
        return view('auth.login', [
            'captcha' => $this->createCaptcha()
        ]);
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

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
            'captcha' => 'required|in:'.session('captcha')
        ],[
            'captcha.in' => 'Wrong captcha! Try again.'
        ]);

        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('status', 'Invalid login details');
        }
        if (auth()->user()->isCustomer)
            return redirect()->route('home');
        else
            return redirect()->route('home.sellers');
    }
}
