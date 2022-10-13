@extends('layouts.admin')
@section('container')

@if ($user->count())
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row d-flex flex-row-reverse">
                <div class="col-sm-4 ">
                    <form action="{{ asset('categories') }}" method="GET">
                        <div class="input-group mb-3 ">
                            <input type="text" class="form-control " placeholder="Search A Category" name="search">
                            <button class="btn btn-danger" type="submit">Search</button>
                          </div>
                    </form>
                </div>
            </div>
            <table class="table table-bordered table-striped table-hover">
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
                                <button type="button"  onclick="getData({{ $data->id }})" class="btn btn-warning" data-toggle="modal" data-target="#updateCategoryModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="/categories/{{ $data->id }}" method="POST" class="mx-3">
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
            </table>
        </div>
    </div>
@else
    <h3 class="text-center fs-4" style="padding: auto">Data Not Found</h3>
@endif

@endsection
