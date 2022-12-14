<?php

namespace App\Http\Controllers;

use App\Models\Performance;
use App\Http\Requests\StorePerformanceRequest;
use App\Http\Requests\UpdatePerformanceRequest;
use App\Models\Employee;

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
            "dataArr" => auth('web')->check() ?
            Performance::with('employee')->paginate(request("paginate") ?? 10):
            Performance::with('employee')->where("employee_id", auth('employee')->user()->id)
            ->paginate(request("paginate") ?? 10),
            "employee" => Employee::all()
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
        if($request->validated()){
            Performance::create([
                "employee_id" => auth('employee')->check() ? auth('employee')->user()->id : $request->employee_id,
                "date" => $request->date,
                "start" => $request->start,
                "end" => null ?? $request->end,
                "description" => $request->description
            ]);

            if(auth('employee')->check()){
                return redirect('administrator/performances')->with("toast_success", "Successfully Creating Perfomance data");
            }
            return back()->with("toast_success", "Successfully Creating Perfomance data");
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
        return response()->json(Performance::find($performance->id), 200);
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
        if($request->has('end')){
            $performance->update(["end" => $request->end]);

            return back()->with("toast_info", "Work has been completed on $request->end");
        }

        if($request->validated()){
            $performance->update([
                "employee_id" => auth('employee')->check() ? auth('employee')->user()->id : $request->employee_id,
                "date" => $request->date,
                "start" => $request->start,
                "description" => $request->description
            ]);

            return back()->with("toast_success", "Successfully Updating Performance data");
        }
        return back()->with("toast_error", "Successfully Updating Performance data");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Performance  $performance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Performance $performance)
    {
        if(Performance::destroy($performance->id)){
            return back()->with("toast_success", "Successfully Deleting Performance data");
        }
        return back()->with("toast_error", "Error when Deleting Performance data");
    }
}
