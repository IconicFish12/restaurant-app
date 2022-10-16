@extends('layouts.admin')
@section('container')


<div class="card shadow mb-4">
    <div class="card-header my-3">
        <button type="button" class="btn btn-danger mx-4" data-toggle="modal" data-target="#createUserModal">
            <i class="fas fa-plus"></i>
            <span>Create</span>
        </button>
    </div>
    <div class="card-body">
        <div class="row d-flex flex-row-reverse">
            <div class="col-sm-4 ">
                <form action="{{ asset('users') }}" method="GET">
                    <div class="input-group mb-3 ">
                        <input type="text" class="form-control" value="{{ request('search') }}" placeholder="Search A User" name="search">
                        <button class="btn btn-danger" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-wrapper">
            <div class="md-card-content" style="overflow-x: auto;">
                <table class="table table-bordered table-striped table-hover" >
                    @if ($user->count())
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Date Birth</th>
                                <th>Phone Number</th>
                                <th>Username</th>
                                <th>email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td style="font-size: 17.8px">{{ $data->firstname }}</td>
                                    <td style="font-size: 17.8px">{{ $data->lastname }}</td>
                                    <td style="font-size: 17.8px">{{ $data->birth }}</td>
                                    <td style="font-size: 17.8px">{{ $data->phone_number }}</td>
                                    <td style="font-size: 17.8px">{{ $data->username }}</td>
                                    <td style="font-size: 17.8px">{{ $data->email }}</td>
                                    <td style="font-size: 17.8px">{{ $data->role }}</td>
                                    <td class="d-flex justify-content-center">
                                        <button type="button"  onclick="getData({{ $data->id }})" class="btn btn-warning" data-toggle="modal" data-target="#updateUserModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="/users/{{ $data->id }}" method="POST" class="mx-3">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" onclick="return alert('Are you Suer want to delete {{ $data->category_name }}')" class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Date Birth</th>
                                <th>Phone Number</th>
                                <th>Username</th>
                                <th>email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    @else
                        <h3 class="text-center">Data Not Found</h3>
                    @endif
                </table>
            </div>
        </div>
        {{ $user->links() }}
    </div>
</div>


<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="userModalLabel">Create User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ asset('users') }}" method="post">
                @csrf
                <div class="form-group">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="firstname">First Name</label>
                                <input type="text" class="form-control form-control-user" id="firstname" value="{{ old('firstname') }}" name="firstname"
                                    placeholder="First Name">
                            </div>
                            <div class="col-sm-6">
                                <label for="lastname">Last Name</label>
                                <input type="text" class="form-control form-control-user" id="lastName" value="{{ old('lastname') }}" name="lastname"
                                    placeholder="Last Name">
                            </div>
                        </div>
                            <div class="form-group">
                            <label for="birth">Birth</label>
                            <input type="date" class="form-control form-control-user" id="birth" value="{{ old('birth') }}" name="birth">
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="number" class="form-control form-control-user" id="phone_number" value="{{ old('phone_number') }}" name="phone_number" placeholder="Your Phone Number">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control form-control-user" id="username" value="{{ old('username') }}" name="username"
                            placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control form-control-user" id="email" value="{{ old('email') }}" name="email"
                            placeholder="Email Address">
                        </div>
                        <div class="form-group ">
                            <label for="password">Password</label>
                            <input type="text" class="form-control form-control-user" value="{{ old('password') }}"
                            id="password" placeholder="Password" name="password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="userModalLabel">Create User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" method="post" id="edit_form">\
                @method('put')
                @csrf
                <div class="form-group">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="firstname">First Name</label>
                                <input type="text" class="form-control form-control-user" id="edit_firstname" name="firstname"
                                    placeholder="First Name">
                            </div>
                            <div class="col-sm-6">
                                <label for="lastname">Last Name</label>
                                <input type="text" class="form-control form-control-user" id="edit_lastname" name="lastname"
                                    placeholder="Last Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="birth">Birth</label>
                            <input type="date" class="form-control form-control-user" id="edit_birth" name="birth">
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" id="edit_role" class="form-select form-control">
                                <option value="costumer" selected> Costumer</option>
                                <option value="admin" selected>Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="number" class="form-control form-control-user" id="edit_phone_number" name="phone_number" placeholder="Your Phone Number">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control form-control-user" id="edit_username" name="username"
                            placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control form-control-user" id="edit_email" name="email"
                            placeholder="Email Address">
                        </div>
                        <div class="form-group ">
                            <label for="password">Password</label>
                            <input type="text" class="form-control form-control-user"
                            id="edit_password" placeholder="Password" name="password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('script')
<script>
    let getData= id => {
    fetch(`users/${id}`).then(response => response.json()).then(response => {
        document.getElementById("edit_form").action = `users/${id}`
        document.getElementById("edit_firstname").value = response.firstname;
        document.getElementById("edit_birth").value = response.birth;
        document.getElementById("edit_phone_number").value = response.phone_number;
        document.getElementById("edit_email").value = response.email;
        document.getElementById("edit_username").value = response.username;
        document.getElementById("edit_role").value = response.role;
        document.getElementById("edit_lastname").value = response.lastname;
    });
}
</script>
@endsection

@endsection
