<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        $remember = $request->remember;

        if(Auth::guard('admin')->attempt($data, $remember)){
            if(User::where("username", $data["username"])->first()->role === "costumer"){
                $request->session()->regenerate();

                return redirect()->intended('/')->with('toast_success', "Welcome, $request->username");
            }

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
            'email' => "required|email:dns",
            'status' => "required",
            'presence' => "required",
            'password' => "required|min:6"
        ]);

        //checking
        if($request->has('email')){
            $employee = Employee::where('email', $data['email'])->first();

            if(is_null($employee)){
                return redirect('/attendance')->with('toast_error', "Your Email is Wrong or not found");
            }

            if(!$employee['password']){
                return redirect('/attendance')->with('toast_error', "Your Password is Wrong");
            }

        }

        $employee = Employee::where('email', $data['email'])->first();
        $query = Attendance::where('email', $data['email'])->where("date", date("Y-m-d", strtotime(now())))->first();
        $in = date("h", strtotime(now())) <= 9;

        //attending
        if($request->has('status') and $request->status === "IN"){
            if(is_null($query) and $in){
                $create = Attendance::create([
                    'employee_id' => $employee['id'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'date' => date(now()),
                    'status' => $data['status'],
                    'in' => date("h:i:s"),
                    'presence' => $data['presence']
                ]);

                if($create){
                    if(Auth::guard('employee')->attempt($request->only(['email', 'password']))){
                        if(Employee::where('email', $data['email'])->first()->status !== "Y"){
                            Auth::logout();

                            return redirect('/attendance')->with('toast_error', 'This Employee is not active');
                        }
                        $request->session()->regenerate();

                        return redirect('/administrator')->with('toast_success', 'Welcome Employee');
                    }
                }
                return back()->with('toast_error', "Absence must be up at 7 am");
            }

            if($data['email'] == $query['email'] and date("d", strtotime($query["date"])) < date("d") and $in){
                    $create = Attendance::create([
                        'employee_id' => $query['id'],
                        'email' => $data['email'],
                        'password' => Hash::make($data['password']),
                        'date' => date(now()),
                        'status' => $data['status'],
                        'in' => date("h:i:s"),
                        'presence' => $data['presence']
                    ]);

                    if($create == true){
                    if(Auth::guard('employee')->attempt($request->only(['email', 'password']))){
                        if(Employee::where('email', $data['email'])->first()->status !== "Y"){
                            Auth::logout();

                            return redirect('/attendance')->with('toast_error', 'This Employee is not active');
                        }
                        $request->session()->regenerate();

                        return redirect('/administrator')->with('toast_success', 'Welcome Employee');
                    }
                }

            }

            if($data['email'] == $query['email']){
                if(Auth::guard('employee')->attempt($request->only(['email', 'password']))){
                    if(Employee::where('email', $data['email'])->first()->status !== "Y"){
                        Auth::logout();

                        return redirect('/attendance')->with('toast_error', 'This Employee is not active');
                    }
                    $request->session()->regenerate();

                    return redirect('/administrator')->with('toast_success', 'Welcome Employee');
                }
            }

        }

        if($request->has('status') and $request->status === "OUT"){

            if($data['email'] == $query['email'] and !is_null($query['out'])){
                if(Auth::guard('employee')->attempt($request->only(['email', 'password']))){
                    if(Employee::where('email', $data['email'])->first()->status !== "Y"){
                        Auth::logout();

                        return redirect('/attendance')->with('toast_error', 'This Employee is not active');
                    }
                    $request->session()->regenerate();

                    return redirect('/administrator')->with('toast_success', 'Welcome Employee');
                }
            }

            if($query['in'] == date("h", strtotime(now())) >= 01){
                $update = Attendance::find($query['id'])->update(['out' => date('h:i:s')]);

                if($update == true ){
                    if(Auth::guard('employee')->attempt($request->only(['email', 'password']))){
                        if(Employee::where('email', $data['email'])->first()->status !== "Y"){
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
        $validated = $request->validate([
            "name" => "required",
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
        if(Auth::guard('employee')->check()){
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect('/attendance')->with('toast_success', 'Success Logout');
        }elseif(Auth::user()->role == "admin"){
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect('/login')->with('toast_success', 'Success Logout');
        }

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('toast_success', 'Success Logout');

    }
}
