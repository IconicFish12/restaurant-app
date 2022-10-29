<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.user', [
            'user' => User::latest()->filter(request(['search']))->paginate(request('paginate') ?? 10),
            'title' => "User Management",
            'page_name' => "User Management"
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::insert([
            "firstname" => $request->firstname,
            "lastname" => $request->lastname,
            "birth" => $request->birth,
            "phone_number" => $request->phone_number,
            "username" => $request->username,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        return back()->with('success', "Successfully Created data User");
    }

    public function show(User $user)
    {
        return response()->json(User::find($user->id));
    }

    public function update(User $user, UpdateUserRequest $request)
    {
        $user->update([
            "firstname" => $request->firstname,
            "lastname" => $request->lastname,
            "birth" => $request->birth,
            "phone_number" => $request->phone_number,
            "username" => $request->username,
            "email" => $request->email,
        ]);

        if($request->password){
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return back()->with('success', 'Successfully Update User Data');
    }

    public function destroy(User $user)
    {
        if(User::destroy($user->id)){
            return back()->with('success', "Successfully Deleting User data");
        }
        return back()->with('error', "Error when Deleting User data");
    }
}
