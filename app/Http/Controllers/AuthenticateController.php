<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;


class AuthenticateController extends Controller
{

    //get request data from registration and store data in user table 
    public function registerUser(UserRequest $request)
    {
        $users = $request->all();
       
        if ($request->get('password') != $request->get('password_confirmation')) {
            return redirect()->route('register');
        }
        $users['password'] = Hash::make($request->get('password'));
        User::create($users);
        return redirect()->route('login');
    }
}
