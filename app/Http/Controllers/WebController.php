<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Order;
use App\Models\Table;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function order()
    {
        return view('web.order', [
            "title" => "Restaurant Menu Ordering",
            "menu" => Menu::all(),
            "table" => Table::all(),
        ]);
    }

    public function orderAction(Request $request)
    {
        // dd($request->all());
        $data = Validator::make($request->all(), [
            "menu_id" => ["required"],
            "table_id" => ["required"],
            "payment_method" => ["required", "max:20"],
            "quantity" => ["required", "integer", "max:200"],
            "price" => ["required", "numeric"],
            "detail" => ["max:200"]
        ]);

        if($data->fails()){
            return back()->with('toast_error', 'Something is wrong');
        }

        $order = Order::create([
            "menu_id" => $request->menu_id,
            "table_id" => $request->table_id,
            "user_id" => auth()->user()->id ,
            "payment_method" => $request->payment_method,
            "order_code" => Str::random(4) . random_int(10, 99) . Str::random('3'),
            "quantity" => $request->quantity,
            "price" => $request->price,
            "detail" => $request->detail,
            "total_pay" => $request->quantity *= $request->price
        ]);

        if($order){
            return back()->with('toast_success', "Thank you for ordering". auth()->user()->name);
        }
        return back()->with('error', "Error When Creating Order");
    }
}
