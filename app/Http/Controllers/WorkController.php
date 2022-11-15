<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Work::with('employee')->where('employee_id', Auth::guard('employee')->user()->id)->first());
        return view('admin.work', [
            "title" => "Work Management",
            "page_name" => "Employee Work",
            "dataArr" => auth('admin')->check() ?
            Work::with('employee')->paginate(request('paginate')??10) :
            Work::with('employee')->where('employee_id', auth('employee')->user()->id)
            ->paginate(request('paginate')??10),
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
     * @param  \App\Http\Requests\StoreWorkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWorkRequest $request)
    {
        // dd($request->all());
        if($request->validated()){
            Work::insert([
                "employee_id" => $request->employee_id,
                "job_desk" => $request->job_desk,
            ]);

            return back()->with('toast_success', "Successfully Creating $request->job_desk");
        }
        return back()->with('error', "Error when Creating $request->job_desk");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function show(Work $work)
    {
        return response()->json(Work::find($work->id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function edit(Work $work)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWorkRequest  $request
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkRequest $request, Work $work)
    {;
        if($request->validated()){
            $work->update([
                "employee_id" => $request->employee_id,
                "job_desk" => $request->job_desk,
                "job_done" => $request->job_done
            ]);

            return back()->with('toast_success', "Successfully Updating Employee Job");
        }
        return back()->with('toast_error', "Error When Updating Employee Job");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function destroy(Work $work)
    {
        if(Work::destroy($work->id)){
            return back()->with('toast_success', "Successfully Deleting Employee Job");
        }
        return back()->with('toast_error', "Error When Deleting Employee Job");
    }
}
