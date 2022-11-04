<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Order;
use App\Models\Employee;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function dashboardView()
    {
        // dd(Order::all()->sum('total_pay'));

        return view('admin.home', [
            "page_name" => "Dashboard Vanushki",
            "menu" =>  Menu::all()->count(),
            "employee" => Employee::all()->count(),
            "order" => Order::all()->sum('total_pay')
        ]);
    }

    public function webView(User $user)
    {
        return view('layouts.web', [
            'user' => User::where("username", "IbnuKamil")->first()
        ]);
    }

    public function documentation()
    {
        return view('admin.documentation', [
            "title" => "Dashboard Documentation",
            "page_name" => "Restaurant Admin Documentation"
        ]);
    }

}
