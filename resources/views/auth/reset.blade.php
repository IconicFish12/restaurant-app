<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body style="background-image: linear-gradient(to right bottom, #d61738, #d7173c, #d8173f, #d81743, #d91746);">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-4 col-md-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">RESET PASSWORD</h1>
                                    </div>
                                    <form method="POST" action="{{ asset('reset-password-action') }}" autocomplete="off">
                                        @csrf
                                        <input type="hidden" name="token" value="{{ $token }}">
                                        <div class="mb-3">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control"
                                                id="email" aria-describedby="emailHelp" name="email"
                                                placeholder="Enter Your email...">
                                        </div>
                                        <div class="mb-3">
                                            <label for="password">New Password</label>
                                            <input type="password" class="form-control" name="password"
                                            id="password" placeholder="Password">
                                            <label for="" style="font-size: 14.7px">
                                                <i class="fas fa-eye mt-2 text-muted" id="toggle" style="margin-left: 5px; cursor: pointer;"></i>
                                                Show Password
                                            </label>
                                        </div>
                                        <button type="submit" class="btn btn-danger d-grid gap-2 col-8 m-auto" style="margin-top: 10px;">Reset Password</button>
                                    </form>
                                    <hr>
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

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    @include('sweetalert::alert')

</body>

</html>



