@extends('layouts.admin')
@section('container')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createMenuModal">
            <i class="fas fa-plus"></i>
            <span>Create</span>
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Menu Name</th>
                        <td>Menu Category</td>
                        <th>Menu Type</th>
                        <th>Menu Price</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($dataArr->count(0))
                        @foreach ($dataArr as $menu)
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $menu->name }}</td>
                            <td>{{ $menu->category->category_name }}</td>
                            <td>{{ $menu->menu_type }}</td>
                            <td>{{ $menu->price }}</td>
                            <td>{{ $menu->image }}</td>
                            <td>{{ $menu->image }}</td>
                            <td class="d-flex justify-content-center">
                                <button type="button"  onclick="getData({{ $menu->id }})" class="btn btn-warning" data-toggle="modal" data-target="#updateCategoryModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="/categories/{{ $menu->id }}" method="POST" class="mx-3">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" onclick="return alert('Are you Sure want to delete {{ $menu->name }}')" class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Menu Name</th>
                        <td>Menu Category</td>
                        <th>Menu Type</th>
                        <th>Menu Price</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

{{-- Modal Create Category --}}
<div class="modal fade" id="createMenuModal" tabindex="-1" aria-labelledby="createCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createCategoryLabel">Create Menu Restaurant</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ asset('menus') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Enter category name">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>

{{-- Modal Update Category --}}
<div class="modal fade" id="updateCategoryModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateModalLabel">Update Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="post" id="edit_form">
            @method('put')
            @csrf
            <div class="form-group">
                <label for="category_name">Category Name</label>
                <input type="text" class="form-control" name="category_name" id="edit_category_name" value="{{ old('category_name') }}" placeholder="Enter category name">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>

<script>
    let getData= id => {
    fetch(`categories/${id}`).then(response => response.json()).then(response => {
        document.getElementById("edit_form").action = `categories/${id}`
        document.getElementById("edit_category_name").value = response.category_name;
    });
}
</script>
@endsection

