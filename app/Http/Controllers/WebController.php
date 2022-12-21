<?php

namespace App\Http\Controllers;

use App\Models\Contact;
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
        $menu = Menu::all();
        // dd($menu);
        return view('web.menu_web', [
            'title' => "Menu restaurant",
            'dataArr' => Menu::all()
        ]);
    }

    public function categoriesView()
    {
        return view('web.category_web', [
            'title' => "Menu Categories"
        ]);
    }

    public function order()
    {
        return view('web.order_web', [
            "title" => "Restaurant Menu Ordering",
            "menu" => Menu::all(),
            "table" => Table::all(),
        ]);
    }

    public function profileView()
    {
        $user = auth('web')->user()->name;

        return view('web.profile_web', [
            'title' => auth()->user()->name. " " . "Profile",
        ]);
    }

    public function historyWeb()
    {
        return view('web.histories_web', [
            'title' => "Order History",
            'dataArr' => Order::where('user_id', auth('web')->user()->id)->get()
        ]);
    }

    public function orderAction(Request $request)
    {
        // dd(Menu::where("id", $request->menu_id)->first()->price);
        $price = Menu::where("id", $request->menu_id)->first()->price;
        $data = Validator::make($request->all(), [
            "menu_id" => ["required"],
            "table_id" => ["required"],
            "payment_method" => ["required", "max:20"],
            "quantity" => ["required", "integer", "max:200"],
            "price" => ["numeric"],
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
            "price" => $request->price ?? null,
            "detail" => $request->detail,
            "total_pay" => $request->quantity *= $request->price ?? $price
        ]);

        return back()->with('toast_success', "Thank you for ordering"." ".auth()->user()->name);
    }

    public function messages(Request $request)
    {
        $data = Validator::make($request->all(), [
            'name' => ["required", "max:100", "string"],
            'email' => ["required", "email:dns", "unique:contacts"],
            'subject' => ["required", "max:50",],
            'message' => ["required", "string"]
        ]);

        if($data->fails()){
            return back()->with('toast_error', "Something is Wrong");
        }

        $messages = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message
        ]);

        return back()->with('toast_success', "Thank you for sending a message, message will be replied via email");
    }

    public function updateProfile(Request $request)
    {

    }
}
