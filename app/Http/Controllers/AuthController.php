<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\RequestStack;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('auth.login');
    }

    public function registerView()
    {
        return view('auth.register');
    }

    public function auth(Request $request)
    {
        $data = $request->validate([
            'email' => "required|email:dns",
            'password' => "required"
        ]);

        if(Auth::attempt($data)){
            if(User::where("email", $data["email"])->first()->role !== "admin"){
                Auth::logout();

                return redirect('login')->with('toast_error', 'You Are Not Admin');
            }

            $request->session()->regenerate();

            return redirect('/administrator')->with('success', "Login Success");
        }

        return redirect("login")->with("toast_error", "Email or password not found or wrong");

    }

    public function registerAction(Request $request)
    {
        // dd($request->all());

        $validated = $request->validate([
            "firstname" => "required",
            "lastname" => "required",
            "birth" => "required|date",
            "phone_number" => "required|unique:users",
            "username" => "required|max:50|unique:users",
            "email" => "required|max:255|email:dns|unique:users",
            "password" => "required|min:6",
        ]);

        $validated["password"] = Hash::make($request->password);

        // dd($validated);

        if(User::create($validated)){
            return redirect('login')->with('toast_success', "Success, You can Login Now");
        }
        return back()->with('toast_error', "Something Went Wrong");
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login')->with('success', 'Success Logout');
    }
}
