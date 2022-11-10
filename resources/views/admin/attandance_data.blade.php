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
                            @auth('admin')
                            <th>Employee Name</th>
                            @endauth
                            <td>Employee Code</td>
                            <th>Attendance Date</th>
                            <th>Absent in</th>
                            <th>Absent Out</th>
                            <th>email</th>
                            <th>Attendace Status</th>
                            <th>Attendace Presence</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataArr as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                @auth('admin')
                                <td>{{ $data->employee->name }}</td>
                                @endauth
                                <td>{{ $data->employee_code }}</td>
                                <td>{{ $data->date }}</td>
                                <td>{{ $data->in }}</td>
                                <td>
                                    @if (is_null($data->out))
                                    No data
                                    @else
                                    {{ $data->out }}
                                    @endif
                                </td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->status}}</td>
                                <td>{{ $data->presence}}</td>
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
                            @auth('admin')
                            <th>Employee Name</th>
                            @endauth
                            <td>Employee Code</td>
                            <th>Attendance Date</th>
                            <th>Absent in</th>
                            <th>Absent Out</th>
                            <th>email</th>
                            <th>Attendace Status</th>
                            <th>Attendace Presence</th>
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

@endsection
