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
    public function attendanceView()
    {
        return view('auth.attendance_auth');
    }

    public function loginView()
    {
        return view('auth.login');
    }

    public function registerView()
    {
        return view('auth.register');
    }

    public function auth(Request $request, User $user)
    {
        $data = $request->validate([
            'username' => "required",
            'password' => "required"
        ]);

        if(Auth::guard('admin')->attempt($data)){
            if(User::where("username", $data["username"])->first()->role !== "admin"){
                Auth::logout();

                return redirect('login')->with('toast_error', 'You Are Not Admin');
            }

            $request->session()->regenerate();

            return redirect('/')->with('success', "Welcome, $request->username");
        }

        return redirect("login")->with("toast_error", "Username or password not found or wrong");

    }

    public function attendanceAction(Request $request)
    {
        dd($request);
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
