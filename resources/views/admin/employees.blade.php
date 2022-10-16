@extends('layouts.admin')
@section('container')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button type="button" class="btn btn-danger mx-3" data-toggle="modal" data-target="#createEmployeeModal">
            <i class="fas fa-plus"></i>
            <span>Create</span>
        </button>
    </div>
    <div class="card-body">
        <div class="row d-flex flex-row-reverse">
            <div class="col-sm-4">
                <form action="{{ asset('employees') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search A Employee" value="{{ request('search') }}" name="search">
                        <button class="btn btn-danger" type="submit">Search</button>
                      </div>
                </form>
            </div>
        </div>
        <div class="table-wrapper">
            <div class="md-card-content" style="overflow-x: auto;">
                <table class="table table-bordered table-striped table-hover">
                    @if ($dataArr->count())
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Employee Name</th>
                            <td>Employee Code</td>
                            <th>Date Birth</th>
                            <th>Age</th>
                            <th>Phone Number</th>
                            <th>Position</th>
                            <th>email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataArr as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->employee_code }}</td>
                                <td>{{ $data->birth }}</td>
                                <td>{{ $data->age }}</td>
                                <td>{{ $data->phone_number }}</td>
                                <td>{{ $data->position}}</td>
                                <td>{{ $data->email}}</td>
                                <td class="d-flex justify-content-center">
                                    <button type="button"  onclick="getData({{ $data->id }})" class="btn btn-warning" data-toggle="modal" data-target="#updateCategoryModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="/employees/{{ $data->id }}" method="POST" class="mx-3">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" onclick="return alert('Are you Sure want to delete {{ $data->name }}')" class="btn btn-danger">
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
                            <th>Employee Name</th>
                            <td>Employee Code</td>
                            <th>Date Birth</th>
                            <th>Age</th>
                            <th>Phone Number</th>
                            <th>Position</th>
                            <th>email</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    @else
                        <h3 class="text-center">Data Not Found</h3>
                    @endif
                </table>
            </div>
        </div>
        {{ $dataArr->links() }}
    </div>
</div>

<div class="modal fade" id="createEmployeeModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="userModalLabel">Create User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ asset('employees') }}" method="post">
                @csrf
                <div class="form-group">
                        <div class="form-group">
                            <label for="name">Employee Name</label>
                            <input type="text" class="form-control form-control-user" id="name" value="{{ old('name') }}" name="name"
                            placeholder="Enter Employee Name">
                        </div>
                            <div class="form-group">
                            <label for="birth">Birth</label>
                            <input type="date" class="form-control form-control-user" id="birth" value="{{ old('birth') }}" name="birth">
                        </div>
                        <div class="form-group">
                            <label for="age">Employee Age</label>
                            <input type="number" class="form-control form-control-user" id="age" value="{{ old('age') }}" name="age" placeholder="Your Phone Number">
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="number" class="form-control form-control-user" id="phone_number" value="{{ old('phone_number') }}" name="phone_number" placeholder="Your Phone Number">
                        </div>
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="text" class="form-control form-control-user" id="position" value="{{ old('position') }}" name="position"
                            placeholder="Enter Employee Position">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control form-control-user" id="email" value="{{ old('email') }}" name="email"
                            placeholder="Email Address">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
