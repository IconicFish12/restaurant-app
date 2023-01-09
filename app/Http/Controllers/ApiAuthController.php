<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
   public function register(Request $request)
   {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'birth' => ['required', 'date'],
            'phone_number' => ["required", "max:15"],
            'username' => ["required", "max:50", "min:6","unique:users"],
            'password' => ["required", "min:6", "unique:users"],
            'email' => ["required", "email:dns", "unique:users"]
        ]);

        if($validator->fails()){
            return response()->json(["message" => $validator->errors()->all()], 400);
        }

        $user =  User::create([
            "name" => $request->name,
            "birth" => $request->birth,
            "phone_number" => $request->phone_number,
            "username" => $request->username,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(["message" => "Registration Success", "access_token" => $token], 201);
   }

   public function login(Request $request)
   {
        $validator = Validator::make($request->only(["email", "password"]), [
            "email" => "required|email:dns",
            "password" => "required|min:6"
        ]);

        if($validator->fails()){
            return response()->json(["message" => $validator->errors()->all()],400);
        }
        $user = User::where("email", $request->email)->first();

        if(!$user){
            return response()->json(["message" => "There is no user with this email"], 400);
        }

        if($user->role != "costumer"){
            return response()->json(["message" => "Forbidden"], 403);
        }

        if(Auth::guard('web')->attempt($request->only(["email", "password"]))){
            $user =  User::where("email", $request->email)->first();
            $token = $user->createToken("auth_token")->plainTextToken;

            return response()->json([
                "message" => "Login Success",
                "access_token" => $token,
                "user_data" => $user
            ], 200);
        }
        return response()->json(["message" => "Unauthorized"], 401);
   }

   public function logout()
   {
        auth()->user()->tokens()->delete();

        return response()->json(["message" => "Successfully Logout"], 200);
   }
}
