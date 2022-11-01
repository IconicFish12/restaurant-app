<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Http\Requests\StoreTableRequest;
use App\Http\Requests\UpdateTableRequest;
use Spatie\Backtrace\Backtrace;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.table', [
            "title" => "Table Management",
            "page_name" => "Restaurant Table",
            "dataArr" => Table::latest()->filter(request(['search']))->paginate(request('paginate') ?? 10)
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
     * @param  \App\Http\Requests\StoreTableRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTableRequest $request)
    {

        if($request->validated()){
            Table::insert(["table_number" => "Table-" . $request->table_number]);

            return back()->with('success', "Successfully Creating Table Number $request->table_number");
        }
        return back()->with('error', "Error When Creating Table Number $request->table_number");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function show(Table $table)
    {
        return response()->json(Table::find($table->id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function edit(Table $table)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTableRequest  $request
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTableRequest $request, Table $table)
    {
        $data = $request->validated();

        if(Table::find($table->id)->update($data)){
            return back()->with('success', "Successfully Updating Table Number $request->table_number");
        }
        return back()->with('error', "Error When Updating Table Number $request->table_number");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function destroy(Table $table)
    {
        if (Table::destroy($table->id)) {
            return back()->with("success", "Successfully Deleting Data Table Number $table->table_number");
        }
        return back()->with("error", "Error When Deleting Data Table Number $table->table_number");
    }
}
