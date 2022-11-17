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
                                    <span><h1 class="h4 text-gray-900 mb-4">Employee Attendance</h1></span>
                                </div>
                                <form method="POST" action="{{ asset('attendance/action') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control form-control-user" name="email"
                                        id="email" placeholder="Employee Email" value="{{ old('email') }}">
                                    </div>
                                    <div class="form-group ">
                                        <label for="email">Presence</label>
                                        <select name="presence" id="presence" class="form-select form-control">
                                            <option value="attend" selected>Attend</option>
                                            <option value="permit">Permit</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control form-control-user" name="password"
                                        id="password" placeholder="Password">
                                        <label for="" style="font-size: 14.7px">
                                            <i class="fas fa-eye mt-2 text-muted" id="toggle" style="margin-left: 5px; cursor: pointer;"></i>
                                            Show Password
                                        </label>
                                    </div>
                                    <div class="mb-4 d-flex align-items-center justify-content-between">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="status1" name="status" checked value="IN" class="custom-control-input ">
                                            <label class="custom-control-label" for="status1">Absent in</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="status2" name="status" value="OUT" class="custom-control-input">
                                            <label class="custom-control-label" for="status2">Absent Out</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-danger btn-user btn-block">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<script>
    const toggle = document.querySelector('#toggle')
    const password = document.querySelector('#password')

    toggle.addEventListener('click', function(e) {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password'
        password.setAttribute('type', type)

        this.classList.toggle('fa-eye-slash');
    })
</script>

@endsection
