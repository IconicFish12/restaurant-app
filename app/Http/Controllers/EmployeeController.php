<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Support\Str;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.employees', [
            'title' => "Employee Management",
            "page_name" => "Employee Management",
            "dataArr" => Employee::latest()->filter(request(['search']))->paginate(request('paginate') ?? 10)
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
     * @param  \App\Http\Requests\StoreEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        if($request->validated()){
            Employee::insert([
                "name" => $request->name,
                "birth" => $request->birth,
                "employee_code" => "employee-" . random_int(10, 99),
                "phone_number" => $request->phone_number,
                "age" => $request->age,
                "position" => $request->position,
                "email" => $request->email
            ]);

            return back()->with('success', "Successfully Create Data $request->name");
        }
        return back()->with('error', "Error Creating Data $request->name");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return response()->json(Employee::find($employee->id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeRequest  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        // dd($request->all());
        $data = $request->validated();

        if($request->has('employee_code')){

            if(Employee::find($employee->id)->update(["employee_code" => $request->employee_code])){
                return back()->with("success", "Successfully updating Employee Code");
            }
        }

        if(Employee::find($employee->id)->update($data)){
            return back()->with("success", "Successfully updating Employee data");
        }
        return back()->with("error", "Error when updating Employee data");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        if(Employee::destroy($employee->id)){
            return back()->with('success', "Successfully Deleting $employee->name");
        }
        return back()->with('error', "Error Deleting $employee->name");
    }
}
