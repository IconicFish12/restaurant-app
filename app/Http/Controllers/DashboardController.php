<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Order;
use App\Models\Employee;
use App\Models\Performance;
use App\Models\Work;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function dashboardView()
    {
        return view('admin.home', [
            "page_name" => auth('web')->check() ? "Dashboard restaurant" : "Dasboard Employee",
            "menu" =>  Menu::all()->count(),
            "employee" => Employee::all()->count(),
            "income" => Order::all()->sum('total_pay') ?? 0,
            "work" => Work::all()->count(),
            "performance" => Performance::all()->count()
        ]);
    }

    public function documentation()
    {
        return view('admin.documentation', [
            "title" => "Dashboard Documentation",
            "page_name" => "Restaurant Admin Documentation"
        ]);
    }

    public function updateProfile(Request $request)
    {
        dd($request->all());
    }

}
