@extends('web.web')
@section('content')
<main id="main">
    <section>
        <div class="mt-3 text-center">
            <h1>{{ auth()->user()->name }} Profile</h1>
        </div>
        <div class="container-lg ">
            <div class="contact">
                <div class="d-flex justify-content-center my-3">
                    
                </div>
                <form action="{{ asset('/profile/update') }}" method="post" class="php-email-form p-3 p-md-4">
                    <div class="row">
                        <div class="col-xl-6 form-group">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" value="{{ auth()->user()->name }}">
                        </div>
                        <div class="col-xl-6 form-group">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" value="{{ auth()->user()->email }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="phone_number" id="phone_number" placeholder="Your Phone Number" value="{{ auth()->user()->phone_number }}">
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" name="birth" id="birth" value="{{ auth()->user()->birth }}">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" id="username" placeholder="Your Subject" value="{{ auth()->user()->username }}">
                    </div>
                    <div class="text-center"><button type="submit">Edit Profile</button></div>
                </form>
            </div>
        </div>
    </section>
</main>
@endsection
