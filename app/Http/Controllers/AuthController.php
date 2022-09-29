<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\RequestStack;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('auth.login');
    }

    public function regiterView()
    {
        return view('auth.register');
    }

    public function authenticate(Request $request)
    {

    }

    public function registerAction(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "phone_number" => "required|numeric|unique:users",
            "username" => "required|max:100|unique:users",
            "email" => "required|email:dns|unique:users",
            "password" => "required|min:6|unique:users",
        ],);

        if($validator->fails()){
            return back()->with('toast_error', $validator->messages()->all()[0]);
        }

        $users = User::insert([

        ]);
    }
}
