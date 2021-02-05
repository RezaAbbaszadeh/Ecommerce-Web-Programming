<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Seller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EditProfileController extends Controller
{
    public function index()
    {
        return view('auth.edit');
    }

    public function store(Request $request)
    {
        if (auth()->user()->isSeller) {
            $this->validate($request, [
                'name' => 'required|max:255',
                'owner' => 'required|max:255',
                'phone_number' => 'required|min:1|max:11|regex:/^[0-9]+$/',
                'address' => 'required|max:255'
            ]);
            Seller::where('id', auth()->user()->profile->id)
                ->update(["owner_name" => $request->owner]);
        } else if (auth()->user()->isCustomer) {
            $this->validate($request, [
                'name' => 'required|max:255',
                'birthday'  => 'required|date_format:Y-m-d|before:today',
                'national_id' => 'required|min:1|max:10|regex:/^[0-9]+$/',
                'phone_number' => 'required|min:1|max:11|regex:/^[0-9]+$/',
                'address' => 'required|max:255',
            ]);
            Customer::where('id', auth()->user()->profile->id)
                ->update(["birthday" => $request->birthday, "national_id" => $request->national_id]);
        }

        User::where('id', auth()->user()->id)
        ->update([
                'name' => $request->name,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
            ]);

        if (auth()->user()->isSeller)
            return redirect()->route('home.sellers');
        else if (auth()->user()->isCustomer)
            return redirect()->route('home');
    }
}
