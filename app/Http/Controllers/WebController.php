<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function webView()
    {
        $user = User::where("role", "costumer")->get();
        $total = $user->count("name");

        return view('web.home',[
            "total_menu" =>  Menu::all()->count(),
            "total_employee" => Employee::all()->count(),
            "total_user" => $total,
            "menu" => Menu::all()
        ]);
    }

    public function menuView()
    {
        return view('web.menu', [
            'title' => "Menu restaurant"
        ]);
    }
}
