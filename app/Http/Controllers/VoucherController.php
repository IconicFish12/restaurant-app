<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Support\Str;
use App\Http\Requests\StoreVoucherRequest;
use App\Http\Requests\UpdateVoucherRequest;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.voucher', [
            "title" => "Restaurant Voucher",
            "page_name" => "Restaurant's Vouchers",
            "dataArr" => Voucher::latest()->filter(request(['search']))->paginate(request('paginate') ?? 10)
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
     * @param  \App\Http\Requests\StoreVoucherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVoucherRequest $request)
    {
        // dd($request);
        if($request->validated()){
            Voucher::insert([
                "name" => $request->name,
                "code" => Str::random(4) . random_int(10, 99),
                "expired" => $request->expired,
                "type" => $request->type,
                "amount" => $request->amount,
                "limit" => $request->limit,
                "minPurchase" => $request->minPurchase,
                "description" => $request->description
            ]);

            return back()->with('success', "Successfully Creating Voucher $request->name");
        }
        return back()->with('error', "Error When Creating Voucher $request->name");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function show(Voucher $voucher)
    {
        return response()->json(Voucher::find($voucher->id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function edit(Voucher $voucher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVoucherRequest  $request
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVoucherRequest $request, Voucher $voucher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voucher $voucher)
    {
        if(Voucher::destroy($voucher->id)){
            return back()->with("success", "Successfully Deleting $voucher->name");
        }
        return back()->with("error", "Error When Deleting $voucher->name");
    }
}
