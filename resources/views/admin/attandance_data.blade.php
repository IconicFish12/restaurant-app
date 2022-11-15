@extends('layouts.admin')
@section('container')

<div class="card shadow mb-4">
    @auth('admin')
    <div class="card-header py-3">
        <button type="button" class="btn btn-danger mx-3" data-toggle="modal" data-target="#createAttendanceModal">
            <i class="fas fa-plus"></i>
            <span>Create</span>
        </button>
    </div>
    @endauth
    <div class="card-body">
        <div class=" d-flex justify-content-between flex-column flex-md-row">
            <div class="col-md-3 ">
                <form action="{{ asset('administrator/attendances-data') }}" method="GET" class="d-block mb-2">
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
                            @auth('admin')
                            <th>Employee Name</th>
                            @endauth
                            <th>Attendance Date</th>
                            <th>Absent in</th>
                            <th>Absent Out</th>
                            @auth('admin')
                            <th>Employee Email</th>
                            @endauth
                            <th>Attendace Status</th>
                            <th>Attendace Presence</th>
                            @auth('admin')
                            <th>Action</th>
                            @endauth
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataArr as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                @auth('admin')
                                <td>{{ $data->employee->name }}</td>
                                @endauth
                                <td>{{ $data->date }}</td>
                                <td>{{ $data->in }}</td>
                                <td>
                                    @if (is_null($data->out))
                                        <p class="text-uppercase text-center">
                                            <i class="fas fa-folder-times"></i>
                                        <span>No Data</span>
                                        </p>
                                    @else
                                    {{ $data->out }}
                                    @endif
                                </td>
                                @auth('admin')
                                <td>{{ $data->email }}</td>
                                @endauth
                                <td>{{ $data->status}}</td>
                                <td>{{ $data->presence}}</td>
                                @auth('admin')
                                <td class="d-flex justify-content-center">
                                    <button type="button"  onclick="getData({{ $data->id }})" class="btn btn-warning" data-toggle="modal" data-target="#updateAttendanceModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ asset('/administrator/attendances-data/'. $data->id) }}" method="POST" class="mx-3">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" onclick="return alert('Are you Sure want to delete {{ $data->name }}')" class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                                @endauth
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            @auth('admin')
                            <th>Employee Name</th>
                            @endauth
                            <th>Attendance Date</th>
                            <th>Absent in</th>
                            <th>Absent Out</th>
                            @auth('admin')
                            <th>Employee Email</th>
                            @endauth
                            <th>Attendace Status</th>
                            <th>Attendace Presence</th>
                            @auth('admin')
                            <th>Action</th>
                            @endauth
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

<div class="modal fade" id="createAttendanceModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Create Employee Attendance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ asset('administrator/attendances-data') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control form-control-user" name="email"
                            id="email" placeholder="Employee Email" value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control form-control-user" name="password"
                            id="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="date">Attendance Date</label>
                            <input type="date" class="form-control form-control-user" id="date" value="{{ old('date') }}" name="date" placeholder="Your Phone Number">
                        </div>
                        <div class="form-group">
                            <label for="in">Absent in</label>
                            <input type="text" class="form-control form-control-user" placeholder="Enter Time In" id="in" value="{{ old('in') }}" name="in">
                        </div>
                        <div class="form-group">
                            <label for="out">Absent out</label>
                            <input type="text" class="form-control form-control-user" placeholder="Enter Time Out" id="out" value="{{ old('out') }}" name="out">
                        </div>
                        <div class="form-group">
                            <label for="status">Attendance Status</label>
                            <select name="status" id="status" class="costum-select form-control">
                                <option value="IN">Absent in</option>
                                <option value="OUT">Absent out</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="presence">Attendance Presence</label>
                            <select name="presence" id="presence" class="costum-select form-control">
                                <option value="attend">Attend</option>
                                <option value="permit">permit</option>
                            </select>
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

<div class="modal fade" id="updateAttendanceModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Update Employee Attendance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="edit_form">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control form-control-user" name="email"
                            id="edit_email" placeholder="Employee Email" value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control form-control-user" name="password"
                            id="edit_password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="date">Attendance Date</label>
                            <input type="date" class="form-control form-control-user" id="edit_date" value="{{ old('date') }}" name="date" placeholder="Your Phone Number">
                        </div>
                        <div class="form-group">
                            <label for="in">Absent in</label>
                            <input type="text" class="form-control form-control-user" id="edit_in" value="{{ old('in') }}" name="in">
                        </div>
                        <div class="form-group">
                            <label for="out">Absent out</label>
                            <input type="text" class="form-control form-control-user" id="edit_out" value="{{ old('out') }}" name="out">
                        </div>
                        <div class="form-group">
                            <label for="status">Attendance Status</label>
                            <select name="status" id="edit_status" class="costum-select form-control">
                                <option value="IN">Absent in</option>
                                <option value="OUT">Absent out</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="presence">Attendance Presence</label>
                            <select name="presence" id="edit_presence" class="costum-select form-control">
                                <option value="attend">Attend</option>
                                <option value="permit">permit</option>
                            </select>
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


<script>
    let getData = id => {
        fetch(`/administrator/attendances-data/${id}`).then(response => response.json()).then(response => {
            document.getElementById("edit_form").action = `/administrator/attendances-data/${id}`
            document.getElementById("edit_email").value = response.email;
            document.getElementById("edit_date").value = response.date
            document.getElementById("edit_in").value = response.in
            document.getElementById("edit_out").value = response.out
            document.getElementById("edit_status").value = response.status
            document.getElementById("edit_presence").value = response.presence
        });
    }
</script>
@endsection
