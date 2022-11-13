@extends('layouts.admin')
@section('container')


<div class="card shadow mb-4">
    @auth('admin')
    <div class="card-header py-3">
        <button type="button" class="btn btn-danger mx-4" data-toggle="modal" data-target="#createWorkModal">
            <i class="fas fa-plus"></i>
            <span>Create</span>
        </button>
    </div>
    @endauth
    <div class="card-body">
        <div class=" d-flex justify-content-between flex-column flex-md-row">
            <div class="col-md-3 ">
                <form action="{{ asset('administrator/works') }}" method="GET" class="d-block mb-2">
                    @if (request()->has("search"))
                    <div class="form-group">
                        <input type="hidden" name="search" class="form-control" value="{{ request('search') }}">
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
            <div class="col-md-3 ">
                <form action="{{ asset('administrator/works') }}" method="GET" class="d-block mb-2">
                    <span class="d-block">Search</span>
                    <div class="input-group mb-3 ">
                        <input type="seacrh" class="form-control " placeholder="Search A Category" value="{{ request('search') }}" name="search">
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
                            <th scope="col">No</th>
                            @auth(auth('admin')->check())
                            <th scope="col">Employee Name</th>
                            @endauth
                            <th scope="col">Job Desk</th>
                            <th scope="col">Job Done</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataArr as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                @auth('admin')
                                <td>{{ $item->employee->name }}</td>
                                @endauth
                                <td>{{ $item->job_desk }}</td>
                                <td>
                                    @if (is_null($item->done))
                                        <p class="text-uppercase text-center">
                                            <i class="fas fa-folder-times"></i>
                                        <span>No Data</span>
                                        </p>
                                    @else
                                        {{ $item->done }}
                                    @endif
                                </td>
                                <td class="d-flex justify-content-center">
                                    <button type="button"  onclick="getData({{ $item->id }})" class="btn btn-warning" data-toggle="modal" data-target="#updateCategoryModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="administrator/works/{{ $item->id }}" method="POST" class="mx-3">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" onclick="return alert('Are you Suer want to delete {{ $item->category_name }}')" class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col">No</th>
                            @auth(auth('admin')->check())
                            <th scope="col">Employee Name</th>
                            @endauth
                            <th scope="col">Employee Job</th>
                            <th scope="col">Job Done</th>
                            <th scope="col">Action</th>
                        </tr>
                    </tfoot>
                    @else
                    <h3 class="text-center">Data Not Found</h3>
                    @endif
                </table>
            </div>
            {{ $dataArr->links() }}
        </div>
    </div>
</div>


<div class="modal fade" id="createWorkModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Create Employee Job</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ asset('administrator/works') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="form-group">
                            <label for="employee_id">Employee Name</label>
                            <select class="costume-select form-control" name="employee_id" id="edit_employee_id" aria-label="Default select example">
                                <option selected > Select Employee</option>
                                @foreach ($employee as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @if (old('employee_id') == $item->id)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="job_desk">Job Desk</label>
                            <input type="text" name="job_desk" id="job_desk" class="form-control" value="{{ old('job_desk') }}" placeholder="Enter Employee Job">
                        </div>
                        <div class="form-group">
                            <label for="job_done">Job Done</label>
                            <input type="time" class="form-control form-control-user" id="job_done" value="{{ old('job_done') }}" name="job_done">
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


@endsection
