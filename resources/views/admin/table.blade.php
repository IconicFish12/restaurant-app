@extends('layouts.admin')
@section('container')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button type="button" class="btn btn-danger mx-4" data-toggle="modal" data-target="#createTableModal">
            <i class="fas fa-plus"></i>
            <span>Create</span>
        </button>
    </div>
    <div class="card-body">
        <div class=" d-flex justify-content-between flex-column flex-md-row">
            <div class="col-md-3 ">
                <form action="{{ asset('administrator/tables') }}" method="GET" class="d-block mb-2">
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
                <form action="{{ asset('administrator/tables') }}" method="GET" class="d-block mb-2">
                    <span class="d-block">Search</span>
                    <div class="input-group mb-3 ">
                        <input type="seacrh" class="form-control " placeholder="Search A Category" value="{{ request('search') }}" name="search">
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
                            <th scope="col">No</th>
                            <th scope="col">Table Number</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataArr as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->table_number }}</td>
                                <td class="d-flex justify-content-center">
                                    <button type="button"  onclick="getData({{ $data->id }})" class="btn btn-warning" data-toggle="modal" data-target="#updateTableModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="/administrator/tables/{{ $data->id }}" method="POST" class="mx-3">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" onclick="return alert('Are you Suer want to delete table {{ $data->table_number }}')" class="btn btn-danger">
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
                            <th scope="col">Category Name</th>
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


{{-- Modal Create Category --}}
<div class="modal fade" id="createTableModal" tabindex="-1" aria-labelledby="createCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createCategoryLabel">Create Table Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ asset('administrator/tables') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="table_number">Table Number</label>
                    <input type="text" class="form-control" name="table_number" id="table_number" value="{{ old('table_number') }}" placeholder="Enter Table Number">
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

{{-- Modal Update Category --}}
<div class="modal fade" id="updateTableModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateModalLabel">Update Table</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="post" id="edit_form">
            @method('put')
            @csrf
            <div class="form-group">
                <label for="table_number">Table Number</label>
                <input type="text" class="form-control" name="table_number" id="edit_table_number" value="{{ old('table_number') }}" placeholder="Enter Table Number">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>

@section('script')
<script>
    let getData= id => {
    fetch(`/administrator/tables/${id}`).then(response => response.json()).then(response => {
        document.getElementById("edit_form").action = `/administrator/tables/${id}`
        document.getElementById("edit_table_number").value = response.table_number;
    });
}
</script>
@endsection

@endsection
