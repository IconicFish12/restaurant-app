<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    public function forgotView()
    {
        return view("auth.forgot");
    }

    public function resetView()
    {
        return view("auth.reset");
    }

    public function forgotAction(Request $request)
    {
        $request->validate([
            "email" => "required|email:dns"
        ]);

        $account = "";

        if(User::where("email", $request->email)->first()){
            DB::table('password_resets')->insert([
                "email" => $request->email,
                "token" => Str::random(60),
                "created_at" => Carbon::now()
            ]);

            $account = User::where("email", $request->email)->first();
        }

        if(Employee::where("email", $request->email)->first()){
            DB::table('password_resets')->insert([
                "email" => $request->email,
                "token" => Str::random(60),
                "created_at" => Carbon::now()
            ]);

            $account = Employee::where("email", $request->email)->first();
        }

        if(!$account){
            return back()->with("toast_error", "User is not found");
        }
        Mail::send();
    }

    public function resetAction()
    {

    }
}
