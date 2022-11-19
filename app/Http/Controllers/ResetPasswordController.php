<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\Models\Employee;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class ResetPasswordController extends Controller
{
    public function forgotView()
    {
        return view("auth.forgot");
    }

    public function resetView($token)
    {
        return view("auth.reset", ["token" => $token]);
    }

    public function forgotAction(Request $request)
    {
        $request->validate([
            "email" => "required|email"
        ]);

        $account = "";
        $token = "";

        if(User::where("email", $request->email)->first()){
            DB::table('password_resets')->insert([
                "email" => $request->email,
                "token" => Str::random(60),
                "user" => "user",
                "created_at" => Carbon::now()
            ]);

            $account = User::where("email", $request->email)->first();
            $token = DB::table('password_resets')->where("email", $request->email)->select("token")->first();
        }

        if(Employee::where("email", $request->email)->first()){
            DB::table('password_resets')->insert([
                "email" => $request->email,
                "token" => Str::random(60),
                "user" => "employee",
                "created_at" => Carbon::now()
            ]);

            $account = Employee::where("email", $request->email)->first();
            $token = DB::table('password_resets')->where("email", $request->email)->select("token")->first();
        }

        if(!$account){
            return back()->with("toast_error", "User is not found");
        }

        Mail::to($request->email)->send(new ResetPassword($token));

        return back()->with("toast_success", "Successfully Send Link Reset password to your email");
    }

    public function resetAction(Request $request)
    {
        $data =  $request->validate([
            'email' => ["required", "email:dns"],
            'password' => "required|min:6|max:20"
        ]);

        $user = DB::table('password_resets')->where(['email' => $data["email"], 'token' => $request->token])->select('user')->first();
        $password = DB::table('password_resets')->where(['email' => $data["email"], 'token' => $request->token])->first();

        if(!$password){
            return back()->with("toast_error", "Invalid Token");
        }

        $update = print_r($user) == "user" ? User::where("email", $request->email)->update(["password" => Hash::make($data["password"])]) : Employee::where("email", $request->email)->update(["password" => Hash::make($data["password"])]);

        DB::table("password_resets")->where("email", $data["email"])->delete();


        if($update){
            return redirect(print_r($user) == "user" ? "/login" : "/attendance")->with("toast_success", "Success Resetting Password");
        }
        return redirect(print_r($user) == "user" ? "/login" : "/attendance")->with("toast_error", "Error When Resetting Password");
    }
}
