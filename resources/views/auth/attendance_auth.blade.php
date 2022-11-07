@extends('layouts.auth')
@section('auth')


<div class="container">


    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-5 col-lg-4 col-md-6">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        {{-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> --}}
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <span><h1 class="h4 text-gray-900 mb-4">Enter Attendance</h1></span>
                                </div>
                                <form method="POST" action="{{ asset('attendance/action') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="code">Employee Code</label>
                                        <input type="text" class="form-control form-control-user"
                                            id="code" aria-describedby="emailHelp" name="code"
                                            placeholder="Enter Your Employee Code">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control form-control-user" name="email"
                                        id="email" placeholder="Employee Email">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="email">Status</label>
                                        <select name="status" id="status" class="form-select form-control">
                                            <option value="attend" selected>Attend</option>
                                            <option value="permit">Permit</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Submit</button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ asset('login') }}">Administrator</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>


@endsection
