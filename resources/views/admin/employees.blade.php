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
        <div class=" d-flex justify-content-between flex-column flex-md-row">
            <div class="col-md-3 ">
                <form action="{{ asset('administrator/employees') }}" method="GET" class="d-block mb-2">
                    @if (request()->has("search"))
                    <div class="form-group">
                        <input type="hidden" name="search" class="form-contrl" value="{{ request('search') }}">
                    </div>
                    @endif
                    <span class="d-block">Data Per Page</span>
                    <input type="number" name="paginate" id="paginate" list="paginates" class="form-control" value="{{ request('paginate') }}">
                    <datalist id="paginates">
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="75">75</option>
                        <option value="100">100</option>
                    </datalist>
                </form>
            </div>
            <div class="col-md-3">
                <form action="{{ asset('administrator/employees') }}" method="GET">
                    <span class="d-block">Search</span>
                    <div class="input-group mb-3">
                        <input type="search" class="form-control" placeholder="Search A Employee" value="{{ request('search') }}" name="search">
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
                            <th>Employee Status</th>
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
                                <td>
                                    <form action="{{ asset('administrator/employees/'. $data->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        @if ($data->status == "Y")
                                            <button type="submit" class="btn btn-success" value="N" name="status">
                                                Active
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-danger" value="Y" name="status">
                                                Non
                                            </button>
                                        @endif
                                    </form>
                                </td>
                                <td>{{ $data->age }}</td>
                                <td>{{ $data->phone_number }}</td>
                                <td>{{ $data->position}}</td>
                                <td>{{ $data->email}}</td>
                                <td class="d-flex justify-content-center">
                                    <button type="button"  onclick="getData({{ $data->id }})" class="btn btn-warning" data-toggle="modal" data-target="#updateEmployeeModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ asset('administrator/employees/'. $data->id) }}" method="POST" class="mx-3">
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
                            <th>Employee Status</th>
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
                <h5 class="modal-title" id="userModalLabel">Create Employee Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ asset('administrator/employees') }}" method="post">
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
                            <label for="status">Employee Status</label>
                            <select name="status" id="status" class="form-select form-control">
                                <option value="Y">Active</option>
                                <option value="N">Not Active</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control form-control-user" id="email" value="{{ old('email') }}" name="email"
                                placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control form-control-user" id="password" value="{{ old('password') }}" name="password"
                                placeholder="Password">
                        </div>
                    </div>
                    <div class="modal-">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="updateEmployeeModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Update Employee Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="edit_form">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <div class="form-group">
                            <label for="name">Employee Name</label>
                            <input type="text" class="form-control form-control-user" id="edit_name" value="{{ old('name') }}" name="name"
                                placeholder="Enter Employee Name">
                        </div>
                        <div class="form-group">
                            <label for="employee_code">Employee Code</label>
                            <input type="text" class="form-control form-control-user" id="edit_employee_code" disabled value="{{ old('employee_code') }}" name="employee_code"
                                placeholder="Enter Employee Name">
                            <label for="employee_code" class="mt-3 text-small text-muted">
                                <input type="checkbox" id="enable">
                                If you want to edit this Code check this
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="birth">Birth</label>
                            <input type="date" class="form-control form-control-user" id="edit_birth" value="{{ old('birth') }}" name="birth">
                        </div>
                        <div class="form-group">
                            <label for="age">Employee Age</label>
                            <input type="number" class="form-control form-control-user" id="edit_age" value="{{ old('age') }}" name="age" placeholder="Your Phone Number">
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="number" class="form-control form-control-user" id="edit_phone_number" value="{{ old('phone_number') }}" name="phone_number" placeholder="Your Phone Number">
                        </div>
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="text" class="form-control form-control-user" id="edit_position" value="{{ old('position') }}" name="position"
                                placeholder="Enter Employee Position">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control form-control-user" id="edit_email" value="{{ old('email') }}" name="email"
                                placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control form-control-user" id="password" value="{{ old('password') }}" name="password"
                                placeholder="Password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script>
        let getData = id => {
            fetch(`/administrator/employees/${id}`).then(response => response.json()).then(response => {
                document.getElementById("edit_form").action = `/administrator/employees/${id}`
                document.getElementById("edit_name").value = response.name;
                document.getElementById("edit_employee_code").value = response.employee_code;
                document.getElementById("edit_birth").value = response.birth;
                document.getElementById("edit_age").value = response.age;
                document.getElementById("edit_phone_number").value = response.phone_number;
                document.getElementById("edit_position").value = response.position;
                document.getElementById("edit_email").value = response.email;
            });
        }

        $(function(){
            $("#enable").click(function(){
                if($(this).is(":checked")){
                    $("#edit_employee_code").removeAttr("disabled");
                    $("#edit_employee_code").focus();
                }else{
                    $("#edit_employee_code").attr("disabled", "disabled");
                }
            })
        })
    </script>
@endsection

@endsection
