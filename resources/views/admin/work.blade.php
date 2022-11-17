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
                            @auth('admin')
                            <th scope="col">Employee Name</th>
                            @endauth
                            <th scope="col">Job Desk</th>
                            <th scope="col">Job Status</th>
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
                                    @if (auth('admin')->check())
                                        @if (is_null($item->job_done))
                                        <div class="text-uppercase text-center">
                                            <i class="fas fa-times"></i>
                                            <span>No Data</span>
                                            <i class="fas fa-times"></i>
                                        </div>
                                        @else
                                        <form action="{{ asset('administrator/works/'. $item->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            @if ($item->job_done === "0")
                                            <button type="submit" class="btn btn-danger" value="1" name="job_done">
                                                Not Finish
                                            </button>
                                            @else
                                            <button type="submit" class="btn btn-success" value="0" name="job_done">
                                                Finish
                                            </button>
                                            @endif
                                        </form>
                                        @endif
                                    @else
                                        @if (is_null($item->job_done))
                                            <div class="text-uppercase text-center">
                                                <i class="fas fa-times"></i>
                                                <span>No Data</span>
                                                <i class="fas fa-times"></i>
                                            </div>
                                        @else
                                            @if ($item->job_done === "0")
                                            <form action="{{ asset('administrator/works/'. $item->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-danger" value="1" name="job_done">
                                                    Not Finish
                                                </button>
                                            </form>
                                            @else
                                                <div class="btn btn-success">Finish</div>
                                            @endif
                                        @endif
                                    @endif
                                </td>
                                @if (Auth::guard('admin')->check())
                                <td class="d-flex justify-content-center">
                                    <button type="button"  onclick="getData({{ $item->id }})" class="btn btn-warning" data-toggle="modal" data-target="#updateWorkModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="/administrator/works/{{ $item->id }}" method="POST" class="mx-3">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" onclick="return alert('Are you Suer want to delete {{ $item->category_name }}')" class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                                @else
                                <td>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#createPerformanceModal">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col">No</th>
                            @auth('admin')
                            <th scope="col">Employee Name</th>
                            @endauth
                            <th scope="col">Employee Job</th>
                            <th scope="col">Job Status</th>
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
                            <select class="costume-select form-control" name="employee_id" id="employee_id" aria-label="Default select example">
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

<div class="modal fade" id="updateWorkModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Update Employee Job</h5>
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
                            <label for="job_done">Job Status</label>
                            <select name="job_done" id="edit_job_done" class="costume-select form-control">
                                <option value="1">Finish</option>
                                <option selected value="0">Not Finish</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="job_desk">Job Desk</label>
                            <input type="text" name="job_desk" id="edit_job_desk" class="form-control" value="{{ old('job_desk') }}" placeholder="Enter Employee Job">
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

<div class="modal fade" id="createPerformanceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add your Performance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ asset('administrator/performances') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" name="date" id="date" value="{{ date("Y-m-d"), old('date') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="start">Start</label>
                        <input type="time" name="start" id="start" value="{{ date("H:i:s"), old('start') }}" class="form-control">
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

@section('script')

<script>
    let getData= id => {
        fetch(`/administrator/works/${id}`).then(response => response.json()).then(response => {
            document.getElementById("edit_form").action = `/administrator/works/${id}`
            document.getElementById("edit_employee_id").value = response.employee_id;
            document.getElementById("edit_job_desk").value = response.job_desk;
            document.getElementById("edit_job_done").value = response.job_done;
        });
    }
</script>

@endsection

@endsection
