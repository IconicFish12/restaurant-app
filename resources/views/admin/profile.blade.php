@extends('layouts.admin')
@section('container')
<div class="mx-3">
    <div class="card">
        <div class="card-title">
            <div class="text-center mt-3" style="font-size: 20px;">
                <p>{{ Auth::user()->name }} Profile</p>
            </div>
        </div>
        <div class="card-body">
            @if (is_null(Auth::user()->profile))
            <img class="img-profile rounded-circle mx-auto d-block" src="{{ asset('/img/undraw_profile.svg') }}" width="150">
            @else
            <img class="img-profile rounded-circle mx-auto d-block" src="{{ Auth::user()->profile }}" width="150">
            @endif
            <form action="{{ asset('/update-profile') }}" method="POST" class="mt-3">
                <div class="col-lg-9 mx-auto">
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="name">Name</label>
                              <input type="text" class="form-control form-control-md" value="{{ Auth::user()->name }}">
                            </div>
                            <div class="col">
                                <label for="username">Username</label>
                              <input type="text" class="form-control form-control-md" value="{{ Auth::user()->username }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">email</label>
                        <input type="text" class="form-control form-control-md" value="{{ Auth::user()->email }}">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="birth">Date Birth</label>
                                <input type="date" class="form-control form-control-md" value="{{ Auth::user()->birth }}">
                            </div>
                            <div class="col">
                                <label for="birth">Phone Number</label>
                                <input type="number" class="form-control form-control-md" value="{{ Auth::user()->phone_number }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="gender">Gender Sex</label>
                                <select name="gender" id="gender" class="form-control" aria-valuenow="{{ Auth::user()->gender ?? null}}">
                                    <option selected>Select Your Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="Photo_Profile">Photo Profile</label>
                                <input type="file" class="form-control" name="profile" id="profile">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="address" id="profile">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const input = document.querySelector('#myFileInput');
  const image = document.querySelector('#myImage');

  input.addEventListener('change', (e) => {
    const file = e.target.files[0];
    const reader = new FileReader();

    reader.addEventListener('load', () => {
      image.src = reader.result;
    });

    reader.readAsDataURL(file);
  });
</script>

@endsection
