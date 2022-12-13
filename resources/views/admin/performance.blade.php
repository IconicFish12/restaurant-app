@extends('layouts.admin')
@section('container')


<div class="card shadow mb-4">
    @auth('admin')
    <div class="card-header py-3">
        <button type="button" class="btn btn-danger mx-3" data-toggle="modal" data-target="#createPerformanceModal">
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
                            <th>Date</th>
                            <th>Job Start</th>
                            <th>Job Finish</th>
                            <th>Description</th>
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
                                <td>{{ $data->date }}</td>
                                <td>{{ $data->start }}</td>
                                <td>
                                    @if (auth('employee')->check())
                                        @if (is_null($data->end))
                                            <button type="submit" class="btn btn-warning" onclick="return alert('Are you sure to finish this job')" data-toggle="modal" data-target="#exampleModal">
                                                Finish
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-warning" onclick="return alert('Are you sure to change this data')" data-toggle="modal" data-target="#exampleModal">
                                                {{ $data->end }}
                                            </button>
                                        @endif
                                    @else
                                        @if (is_null($data->end))
                                            <div class="text-uppercase text-center">
                                                <i class="fas fa-times"></i>
                                                <span>No Data</span>
                                                <i class="fas fa-times"></i>
                                            </div>
                                        @else
                                        {{ $data->end }}
                                        @endif
                                    @endif
                                </td>
                                <td>{{ $data->description }}</td>
                                <td class="d-flex justify-content-center">
                                    <button type="button"  onclick="getData({{ $data->id }})" class="btn btn-warning" data-toggle="modal" data-target="#updatePerformanceModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ asset('/administrator/performances/'. $data->id) }}" method="POST" class="mx-3">
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
                            <th>Date</th>
                            <th>Job Start</th>
                            <th>Job Finish</th>
                            <th>Description</th>
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

<div class="modal fade" id="createPerformanceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Performance data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ asset('administrator/performances') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="employee_id">Employee Name</label>
                        <select name="employee_id" id="employee_id" class="form-control">
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
                        <label for="date">Date</label>
                        <input type="date" name="date" id="date" value="{{ date("Y-m-d"), old('date') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="start">Start</label>
                        <input type="time" name="start" id="start" value="{{ date("H:i"), old('start') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="end">End</label>
                        <input type="time" name="end" id="end" value="{{ old('end') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" placeholder="What are you doing today"></textarea>
                    </div>
                    @csrf
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updatePerformanceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Performance data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="edit_form">
                    @method('PUT')
                    @csrf
                    @auth('admin')
                    <div class="form-group">
                        <label for="employee_id">Employee Name</label>
                        <select name="employee_id" id="edit_employee_id" class="form-control">
                            <option selected > Select Employee</option>
                            @foreach ($employee as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @if (old('employee_id') == $item->id)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    @endauth
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" name="date" id="edit_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="start">Job Start</label>
                        <input type="time" name="start" id="edit_start"  class="form-control">
                    </div>
                    @auth('admin')
                    <div class="form-group">
                        <label for="end">Job End</label>
                        <input type="time" name="end" id="edit_end"  class="form-control">
                    </div>
                    @endauth
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="edit_description" class="form-control" placeholder="What are you doing today"></textarea>
                    </div>
                    @csrf
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Finish Job</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="edit_form">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="end">Job Finish</label>
                        <input type="time" name="end" id="end" value="{{ date("H:i") }}" class="form-control">
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
        let getData= id => {
        fetch(`/administrator/performances/${id}`).then(response => response.json()).then(response => {
            document.getElementById("edit_form").action = `/administrator/performances/${id}`
            @auth('admin')
            document.getElementById("edit_employee_id").value = response.employee_id;
            document.getElementById("edit_end").value = response.end;
            @endauth
            document.getElementById("edit_date").value = response.date;
            document.getElementById("edit_start").value = response.start;
            document.getElementById("edit_description").value = response.description;
        });
    }
    </script>
@endsection

@endsection
