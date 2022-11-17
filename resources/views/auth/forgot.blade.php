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
                                    <h1 class="h4 text-gray-900 mb-4">SEND EMAIL TO RESET PASSWORD</h1>
                                </div>
                                <form class="" method="POST" action="{{ asset('forgotAction') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control form-control-user" name="email"
                                        id="email" placeholder="Your Email">
                                    </div>
                                    <button type="submit" class="btn btn-danger btn-user btn-block">Send Email</button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ asset('login') }}">Login</a>
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
