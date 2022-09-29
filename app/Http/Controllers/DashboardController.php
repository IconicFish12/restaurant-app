<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function dashboardView()
    {
        return view('layouts.admin');
    }

    public function webView(Request $request, User $user)
    {
        return view('layouts.home', [
            'user' => User::where("username", "IconicFish")->get()
        ]);
    }

}
