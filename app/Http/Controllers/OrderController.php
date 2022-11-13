<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.order', [
            "title" => "Order Management",
            "page_name" => "Costumer Order",
            "dataArr" => Order::filter(request(['search']))->with(['user', 'menu', 'table'])->paginate(request('paginate') ?? 10),
            "menu" => Menu::all(),
            "table" => Table::all(),
            "user" => User::where("role", "costumer")->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\Order  $order
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        if($request->validated()){
            Order::create([
                "menu_id" => $request->menu_id,
                "table_id" => $request->table_id,
                "user_id" => $request->user_id,
                "payment_method" => $request->payment_method,
                "order_code" => Str::random(4) . random_int(10, 99) . Str::random('3'),
                "quantity" => $request->quantity,
                "price" => $request->price,
                "detail" => $request->detail,
                "total_pay" => $request->quantity *= $request->price
            ]);

            return back()->with('success', "Successfully Creating Data Order");
        }
        return back()->with('error', "Error When Creating Order");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return response()->json(Order::find($order->id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {

        if($request->validated()){
            $order->update([
                "menu_id" => $request->menu_id,
                "user_id" => $request->user_id,
                "table_id" => $request->table_id,
                "payment_method" => $request->payment_method,
                "quantity" => $request->quantity,
                "detail" => $request->detail,
                "price" => $request->price,
                "total_pay" => $request->quantity *= $request->price
            ]);

            return back()-> with('toast_success', "Successfully Updating Order code $order->order_code");
        }
        return back()-> with('error', "Error when Updating Order code $order->order_code");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        if(Order::destroy($order->id)) {
            return back()->with('success', "Successfully Deleting Order data");
        }
        return back()->with('error', "Error When Deleting Order data");
    }

    public function orderHistory()
    {
        return view('admin.history', [
            "title" => "History Management",
            "page_name" => "Costumer Order History",
            "dataArr" => Order::filter(request(['search']))->paginate(request('paginate')??10)
        ]);
    }

}
