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
            "page_name" => auth('admin')->check() ? "Dashboard restaurant" : "Dasboard Employee",
            "menu" =>  Menu::all()->count(),
            "employee" => Employee::all()->count(),
            "income" => Order::all()->sum('total_pay') ?? 0,
            "work" => Work::all()->count(),
            "performance" => Performance::all()->count()
        ]);
    }

    public function webView()
    {
        $user = User::where("role", "costumer")->get();
        $total = $user->count("name");

        return view('layouts.web',[
            "total_menu" =>  Menu::all()->count(),
            "total_employee" => Employee::all()->count(),
            "total_user" => $total,
            "menu" => Menu::all()
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
