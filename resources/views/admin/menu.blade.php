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
        <div class=" d-flex justify-content-between flex-column flex-md-row">
            <div class="col-md-3 ">
                <form action="{{ asset('administrator/menus') }}" method="GET" class="d-block mb-2">
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
                <form action="{{ asset('administrator/menus') }}" method="GET" class="d-block mb-2">
                    <span class="d-block">Search</span>
                    <div class="input-group mb-3">
                        <input type="search" class="form-control" placeholder="Search A Menu" value="{{ request('search') }}" name="search">
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
                            <th>Menu Name</th>
                            <td>Menu Category</td>
                            <th>Menu Price</th>
                            <th>Image</th>
                            <th>Brief Description</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataArr as $menu)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $menu->name }}</td>
                                <td>{{ $menu->category->category_name }}</td>
                                <td>@money($menu->price)</td>
                                <td>
                                    @if (Storage::disk("public_path")->exists($menu->image))
                                    <img src="{{ asset($menu->image) }}" alt="" width="85px">
                                    @else
                                    <i class="fas fa-image"></i>
                                    <span>Image Not Found</span>
                                    @endif
                                </td>
                                <td>{{ $menu->brief_description }}</td>
                                <td>{{ $menu->description}}</td>
                                <td class="d-flex justify-content-center">
                                    <button type="button"  onclick="getData({{ $menu->id }})" class="btn btn-warning" data-toggle="modal" data-target="#updateCategoryModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="/administrator/menus/{{ $menu->id }}" method="POST" class="mx-3">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" onclick="return alert('Are you Sure want to delete {{ $menu->name }}')" class="btn btn-danger">
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
                            <th>Menu Name</th>
                            <td>Menu Category</td>
                            <th>Menu Price</th>
                            <th>Image</th>
                            <th>Brief Description</th>
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
                <form action="{{ asset('administrator/menus') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Menu Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Enter Menu name">
                    </div>
                    <div class="form-group">
                        <label for="category_id">Menu Category</label>
                        <select class="form-select form-control" name="category_id" id="category_id" aria-label="Default select example">
                        <option value="" selected>Select Category Menu</option>
                            @foreach ($category as $item)
                                <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                @if (old('category_id') == $item->id)
                                    <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                @endif
                            @endforeach
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
                        <label for="menu_type">Short Description</label>
                        <textarea name="brief_description" id="brief_description" aria-valuenow="{{ old('brief_description') }}" class="form-control" rows="4" placeholder="Enter Brief Decsription"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Menu Description</label>
                        <textarea name="description" id="description" aria-valuenow="{{ old('description') }}" class="form-control" rows="4" placeholder="Enter Menu Decsription"></textarea>
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
                        <input type="text" class="form-control" name="name" id="edit_name" value="{{ old('name') }}" placeholder="Enter Menu name">
                    </div>
                    <div class="form-group">
                        <label for="category_id">Menu Category</label>
                        <select class="form-select form-control" name="category_id" id="edit_category_id" aria-label="Default select example">
                            <option selected >Select Category</option>
                            @foreach ($category as $item)
                                <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                @if (old('category_id') == $item->id)
                                    <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Menu Price</label>
                        <input type="number" class="form-control" name="price" id="edit_price" value="{{ old('price') }}" placeholder="Enter Menu price">
                    </div>
                    <div class="form-group">
                        <label for="image">Menu Image</label>
                        <input type="file" class="form-control" name="image" id="edit_image" value="{{ old('image') }}" placeholder="Enter Menu price">
                    </div>
                    <div class="form-group">
                        <label for="menu_type">Menu Type</label>
                        <textarea name="brief_description" id="edit_brief_description" class="form-control" rows="4" placeholder="Enter Brief Decsription"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Menu Description</label>
                        <textarea name="description" id="edit_description" class="form-control" rows="4" placeholder="Enter Menu Decsription"></textarea>
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

<script>
    let getData= id => {
        fetch(`/administrator/menus/${id}`).then(response => response.json()).then(response => {
            document.getElementById("edit_form").action = `/administrator/menus/${id}`
            document.getElementById("edit_name").value = response.name;
            document.getElementById("edit_category_id").value = response.category_id
            document.getElementById("edit_brief_description").value = response.brief_description
            document.getElementById("edit_price").value = response.price
            document.getElementById("edit_description").value = response.description
        });
    }
</script>

@endsection

