@extends('layouts.admin')
@section('container')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button type="button" class="btn btn-danger mx-3" data-toggle="modal" data-target="#createContactModal">
            <i class="fas fa-plus"></i>
            <span>Create</span>
        </button>
    </div>
    <div class="card-body">
        <div class=" d-flex justify-content-between flex-column flex-md-row">
            <div class="col-md-3 ">
                <form action="{{ asset('administrator/messages') }}" method="GET" class="d-block mb-2">
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
            <div class="col-md-3 ">
                <form action="{{ asset('administrator/messages') }}" method="GET" >
                    <span class="d-block">Search</span>
                    <div class="input-group mb-3">
                        <input type="search" class="form-control" placeholder="Search A Contact Data" value="{{ request('search') }}" name="search">
                      </div>
                </form>
            </div>
        </div>
        <div class="table-wrapper">
            <div class="md-card-content" style="overflow-x: auto;">
                <table class="table table-bordered table-striped">
                    @if ($dataArr->count())
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <td>Email</td>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataArr as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->message }}</td>
                                <td class="d-flex justify-content-center">
                                    <button type="button"  onclick="getData({{ $data->id }})" class="btn btn-warning" data-toggle="modal" data-target="#updateEmployeeModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="administrator/messages/{{ $data->id }}" method="POST" class="mx-3">
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
                            <th>Name</th>
                            <td>Email</td>
                            <th>Message</th>
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


<div class="modal fade" id="createContactModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="userModalLabel">Create User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ asset('administrator/messages') }}" method="post">
                @csrf
                <div class="form-group">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control form-control-user" id="name" value="{{ old('name') }}" name="name"
                            placeholder="Enter Employee Name">
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="number" class="form-control form-control-user" id="phone_number" value="{{ old('phone_number') }}" name="phone_number" placeholder="Your Phone Number">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control form-control-user" id="email" value="{{ old('email') }}" name="email"
                            placeholder="Email Address">
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" class="form-control" rows="3" placeholder="Enter The Message" aria-valuenow="{{ old('description') }}"></textarea>
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
@section('script')

<script>

</script>

@endsection

@endsection
