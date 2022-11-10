<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\User;
use Attribute;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\RequestStack;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function attendanceView()
    {
        return view('auth.attendance_auth');
    }

    public function loginView()
    {
        return view('auth.login');
    }

    public function registerView()
    {
        return view('auth.register');
    }

    public function auth(Request $request, User $user)
    {
        $data = $request->validate([
            'username' => "required",
            'password' => "required"
        ]);

        if(Auth::guard('admin')->attempt($data)){
            if(User::where("username", $data["username"])->first()->role !== "admin"){
                Auth::logout();

                return redirect('login')->with('toast_error', 'You Are Not Admin');
            }

            $request->session()->regenerate();

            return redirect('/administrator')->with('toast_success', "Welcome, $request->username");
        }

        return redirect("login")->with("toast_error", "Username or password not found or wrong");

    }

    public function attendanceAction(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'employee_code' => "required|max:15",
            'email' => "required|email:dns",
            'status' => "required",
            'presence' => "required",
            'password' => "required|min:6"
        ]);

        //login
        if($request->has('employee_code') && $request->has('email')){
            $code = Employee::where('employee_code', $request->employee_code)->first();
            $email = Employee::where('email', $request->email)->first();
            $password = Employee::where('password', $request->password)->first();

            if(!$email and !$code and !$password){
                return redirect('/attendance')->with('toast_error', 'Something not match');
            }
        }

        $query = Attendance::where('employee_code', $data['employee_code'])->where("date", date("Y-m-d", strtotime(now())))->first();
//attending
        if($request->has('status') and $request->status === "IN"){
            if(is_null($query)){
                $create = Attendance::create([
                    'employee_code' => $data['employee_code'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'date' => date(now()),
                    'status' => $data['status'],
                    'in' => date("h:i:s"),
                    'presence' => $data['presence']
                ]);

                if($create){
                    if(Auth::guard('employee')->attempt($request->only(['employee_code', 'email', 'password']))){
                        if(Employee::where('employee_code', $data['employee_code'])->first()->status !== "Y"){
                            Auth::logout();

                            return redirect('/attendance')->with('toast_error', 'This Employee is not active');
                        }
                        $request->session()->regenerate();

                        return redirect('/administrator')->with('toast_success', 'Welcome Employee');
                    }
                }
                // $date= $query['date'] > date("Y-m-d");
            }

            if($data['employee_code'] == $query['employee_code'] and date("d", strtotime($query["date"])) < date("d")){
                    $create = Attendance::create([
                        'employee_code' => $data['employee_code'],
                        'email' => $data['email'],
                        'password' => Hash::make($data['password']),
                        'date' => date(now()),
                        'status' => $data['status'],
                        'in' => date("h:i:s"),
                        'presence' => $data['presence']
                    ]);

                    if($create == true){
                    if(Auth::guard('employee')->attempt($request->only(['employee_code', 'email', 'password']))){
                        if(Employee::where('employee_code', $data['employee_code'])->first()->status !== "Y"){
                            Auth::logout();

                            return redirect('/attendance')->with('toast_error', 'This Employee is not active');
                        }
                        $request->session()->regenerate();

                        return redirect('/administrator')->with('toast_success', 'Welcome Employee');
                    }
                }

            }

            if($data['employee_code'] == $query['employee_code']){
                if(Auth::guard('employee')->attempt($request->only(['employee_code', 'email', 'password']))){
                    if(Employee::where('employee_code', $data['employee_code'])->first()->status !== "Y"){
                        Auth::logout();

                        return redirect('/attendance')->with('toast_error', 'This Employee is not active');
                    }
                    $request->session()->regenerate();

                    return redirect('/administrator')->with('toast_success', 'Welcome Employee');
                }
            }


        }

        if($request->has('status') and $request->status === "OUT"){

            // dd($query['in'] == date("h", strtotime(now())) >= 01);
            if($query['in'] == date("h", strtotime(now())) >= 01){
                $update = Attendance::find($query['id'])->update(['out' => date('h:i:s')]);

                if($update == true ){
                    if(Auth::guard('employee')->attempt($request->only(['employee_code', 'email', 'password']))){
                        if(Employee::where('employee_code', $data['employee_code'])->first()->status !== "Y"){
                            Auth::logout();

                            return redirect('/attendance')->with('toast_error', 'This Employee is not active');
                        }
                        $request->session()->regenerate();

                        return redirect('/administrator')->with('toast_success', 'Welcome Employee');
                    }
                }

                return redirect('/attendance')->with('toast_error', "Absent out of the day at 9 am and above");
            }

        }

        return redirect('/attendance')->with('toast_error', "Something is wrong");

    }

    public function registerAction(Request $request)
    {
        // dd($request->all());

        $validated = $request->validate([
            "firstname" => "required",
            "lastname" => "required",
            "birth" => "required|date",
            "phone_number" => "required|unique:users",
            "username" => "required|max:50|unique:users",
            "email" => "required|max:255|email:dns|unique:users",
            "password" => "required|min:6",
        ]);

        $validated["password"] = Hash::make($request->password);

        if(User::create($validated)){
            return redirect('login')->with('toast_success', "Success, You can Login Now");
        }
        return back()->with('toast_error', "Something Went Wrong");
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login')->with('success', 'Success Logout');
    }
}
