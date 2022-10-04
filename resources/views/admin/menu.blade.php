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
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $menu->name }}</td>
                                <td>{{ $menu->category->category_name }}</td>
                                <td>{{ $menu->menu_type }}</td>
                                <td>@money($menu->price)</td>
                                <td>
                                    @if (File::exists($menu->image))
                                        <img src="{{ asset($menu->image) }}" alt="" width="85px">
                                    @else
                                        <i class="fas fa-image"></i>
                                        <span>Image Not Found</span>
                                    @endif
                                </td>
                                <td>{{ $menu->description}}</td>
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
                            </tr>
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

{{-- Modal Create Menu --}}
<div class="modal fade" id="createMenuModal" tabindex="-1" aria-labelledby="createMenuLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createMenuLabel">Create Menu Restaurant</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ asset('menus') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Menu Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Enter Menu name">
                </div>
                <div class="form-group">
                    <label for="category_id">Menu Category</label>
                    <select class="form-select form-control" name="category_id" id="category_id" aria-label="Default select example">
                        @foreach ($category as $item)
                            <option selected value="{{ $item->id }}">{{ $item->category_name }}</option>
                            @if (old('category_id') == $item->id)
                                <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="menu_type">Menu Type</label>
                    <select class="form-select form-control" name="menu_type" id="menu_type" aria-label="Default select example">
                        <option value="mainCourse">Main Course</option>
                        <option value="appetizer">Appetizer</option>
                        <option value="dessert">Dessert</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="price">Menu Price</label>
                    <input type="number" class="form-control" name="price" id="price" value="{{ old('price') }}" placeholder="Enter Menu price">
                </div>
                <div class="form-group">
                    <label for="image">Menu Image</label>
                    <input type="file" class="form-control" name="image" id="image" value="{{ old('image') }}" placeholder="Enter Menu price">
                </div>
                <div class="form-group">
                    <label for="description">Menu Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter Menu Decsription"></textarea>
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
          <form action="" method="post" id="edit_form" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="form-group">
                <label for="name">Menu Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Enter Menu name">
            </div>
            <div class="form-group">
                <label for="category_id">Menu Category</label>
                <select class="form-select form-control" name="category_id" id="category_id" aria-label="Default select example">
                    @foreach ($category as $item)
                        <option selected value="{{ $item->id }}">{{ $item->category_name }}</option>
                        @if (old('category_id') == $item->id)
                            <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="menu_type">Menu Type</label>
                <select class="form-select form-control" name="menu_type" id="menu_type" aria-label="Default select example">
                    <option value="mainCourse">Main Course</option>
                    <option value="appetizer">Appetizer</option>
                    <option value="dessert">Dessert</option>
                </select>
            </div>
            <div class="form-group">
                <label for="price">Menu Price</label>
                <input type="number" class="form-control" name="price" id="price" value="{{ old('price') }}" placeholder="Enter Menu price">
            </div>
            <div class="form-group">
                <label for="image">Menu Image</label>
                <input type="file" class="form-control" name="image" id="image" value="{{ old('image') }}" placeholder="Enter Menu price">
            </div>
            <div class="form-group">
                <label for="description">Menu Description</label>
                <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter Menu Decsription"></textarea>
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

