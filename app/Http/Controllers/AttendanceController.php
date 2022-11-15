<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.attandance_data', [
            "title" => "Attendance management",
            "page_name" => "Employee Attendance",
            "dataArr" => auth('admin')->check() ?
            Attendance::with('employee')->paginate(request('paginate') ?? 10) :
            Attendance::with('employee')
            ->where('employee_id', auth('employee')->user()->id)
            ->paginate(request('paginate') ?? 10),
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
     * @param  \App\Http\Requests\StoreAttendanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAttendanceRequest $request)
    {
        //validation
        $data =$request->validated();

        //checking
        if($request->has('email')){
            $employee = Employee::where('email', $data['email'])->first();
            // dd(!$employee['password']);

            if(is_null($employee)){
                return back()->with('toast_error', "Email is wrong or not found");
            }

            if(!$employee['password']){
                return back()->with('toast_error', "Password is Wrong");
            }
        }
        $employee = Employee::where('email', $data['email'])->first();

        //creating data
        if($data){
            Attendance::create([
                'employee_id' => $employee['id'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'date' => $data['date'],
                'status' => $data['status'],
                'in' => $data['in'],
                'out' => $data['out'],
                'presence' => $data['presence']
            ]);

            return back()->with('toast_success', "Successfully Creating Attendance Data");
        }
        return back()->with('toast_error', "Error When Creating Attendance Data");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        return response()->json(Attendance::find($attendance->id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAttendanceRequest  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        //validation
        $data =$request->validated();

        //checking
        if($request->has('email')){
            $employee = Employee::where('email', $data['email'])->first();
            // dd(!$employee['password']);

            if(is_null($employee)){
                return back()->with('toast_error', "Email is wrong or not found");
            }

            if(!$employee['password']){
                return back()->with('toast_error', "Password is Wrong");
            }
        }
        $employee = Employee::where('email', $data['email'])->first();

        if($data){
            $attendance->update([
                'employee_id' => $employee['id'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'date' => $data['date'],
                'status' => $data['status'],
                'in' => $data['in'],
                'out' => $data['out'],
                'presence' => $data['presence']
            ]);

            return back()->with('toast_success', "Successfully Updating Attendance Data");
        }
        return back()->with('toast_error', "Error When Updating Attendance Data");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        if($attendance->destroy($attendance->id)){
            return back()->with('toast_success', "Successfully Deleting Attendance Data");
        }
        return back()->with('toast_error', "Error When Deleting Attendance Data");
    }
}
