<?php

namespace App\Http\Controllers;

use App\Models\Performance;
use App\Http\Requests\StorePerformanceRequest;
use App\Http\Requests\UpdatePerformanceRequest;

class PerformanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.performance', [
            "title" => "Performance Management",
            "page_name" =>  "Employee Performance",
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
     * @param  \App\Http\Requests\StorePerformanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePerformanceRequest $request)
    {
        // dd($request->all());

        if($request->validated()){
            Performance::create([
                "employee_id" => auth('employee')->check() ? auth('employee')->user()->id : $request->employee_id,
                "date" => $request->date,
                "start" => $request->start,
                "end" => null,
                "description" => $request->description
            ]);

            return redirect('administrator/performances')->with("toast_success", "Successfully Creating Perfomance data");
        }
        return back()->with("toast_error", "Error when Creating Perfomance data");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Performance  $performance
     * @return \Illuminate\Http\Response
     */
    public function show(Performance $performance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Performance  $performance
     * @return \Illuminate\Http\Response
     */
    public function edit(Performance $performance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePerformanceRequest  $request
     * @param  \App\Models\Performance  $performance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePerformanceRequest $request, Performance $performance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Performance  $performance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Performance $performance)
    {
        //
    }
}
