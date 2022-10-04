<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function dashboardView()
    {
        return view('layouts.admin', [
            "page_name" => "Dashboard Vanushki",
            "user" => User::where('role', 'admin')->first()
        ]);
    }

    public function webView(User $user)
    {

        return view('layouts.web', [
            'user' => User::where("username", "IbnuKamil")->first()
        ]);
    }

}
