@extends('layouts.admin')
@section('container')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button type="button" class="btn btn-danger mx-3" data-toggle="modal" data-target="#createMenuModal">
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

@endsection
