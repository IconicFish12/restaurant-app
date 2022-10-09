@extends('layouts.auth')
@section('auth')
<div class="container py-5">

    <div class="col-xl-6 col-lg-4 col-md-6 mx-auto">
        <div class="card o-hidden border-0 shadow-md ">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="justify-content-center d-flex">
                    {{-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> --}}
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form action="{{ asset('registration/register') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="firstname">First Name</label>
                                        <input type="text" class="form-control form-control-user" id="firstname" name="firstname"
                                            placeholder="First Name">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="lastname">Last Name</label>
                                        <input type="text" class="form-control form-control-user" id="lastName" name="lastname"
                                            placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="birth">Birth</label>
                                    <input type="date" class="form-control form-control-user" id="birth" name="birth">
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="number" class="form-control form-control-user" id="phone_number" name="phone_number" placeholder="Your Phone Number">
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control form-control-user" id="username" name="username"
                                        placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control form-control-user" id="email" name="email"
                                        placeholder="Email Address">
                                </div>
                                <div class="form-group ">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control form-control-user"
                                        id="password" placeholder="Password" name="password">
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">Register Account</button>
                            </form>
                            <hr>
                            {{-- <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div> --}}
                            <div class="text-center">
                                <a class="small" href="{{ asset('login') }}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
