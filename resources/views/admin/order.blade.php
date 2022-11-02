@extends('layouts.admin')
@section('container')


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button type="button" class="btn btn-danger mx-3" data-toggle="modal" data-target="#createOrderModal">
            <i class="fas fa-plus"></i>
            <span>Create</span>
        </button>
    </div>
    <div class="card-body">
        <div class=" d-flex justify-content-between flex-column flex-md-row">
            <div class="col-md-3 ">
                <form action="{{ asset('orders') }}" method="GET" class="d-block mb-2">
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
                <form action="{{ asset('orders') }}" method="GET">
                    <span class="d-block">Search</span>
                    <div class="input-group mb-3">
                        <input type="search" class="form-control" placeholder="Search A Costumer Order" value="{{ request('search') }}" name="search">
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
                            <th>Menu Name</th>
                            <td>Costumer</td>
                            <th>Table Number</th>
                            <th>Payment Method</th>
                            <th>Order Code</th>
                            <th>Quantity</th>
                            <th>detail</th>
                            <th>Price</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataArr as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->menu->name }}</td>
                                <td>{{ $data->user->firstname }}</td>
                                <td>{{ $data->table->table_number }}</td>
                                <td>{{ $data->payment_method }}</td>
                                <td>{{ $data->order_code }}</td>
                                <td>{{ $data->quantity}}</td>
                                <td>{{ $data->detail}}</td>
                                <td>@money($data->price)</td>
                                <td>@money($data->total_pay)</td>
                                <td class="d-flex justify-content-center">
                                    <button type="button"  onclick="getData({{ $data->id }})" class="btn btn-warning" data-toggle="modal" data-target="#updateOrderModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="/orders/{{ $data->id }}" method="POST" class="mx-3">
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
                            <th>Menu Name</th>
                            <td>Costumer</td>
                            <th>Table Number</th>
                            <th>Payment Method</th>
                            <th>Order Code</th>
                            <th>Quantity</th>
                            <th>detail</th>
                            <th>Price</th>
                            <th>Total Price</th>
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


<div class="modal fade" id="createOrderModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="userModalLabel">Create User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ asset('orders') }}" method="post">
                @csrf
                <div class="form-group">
                        <div class="form-group">
                            <label for="menu_id">Menu</label>
                            <select name="menu_id" id="menu_id" class="form-control">
                                <option value="" selected>Select The Menu</option>
                                @foreach ($menu as $item)
                                    @if (old('menu_id' == $item->id))
                                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                    @endif
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user_id">User</label>
                            <select name="user_id" id="user_id" class="form-control">
                                <option value="" selected>Select The User</option>
                                @foreach ($user as $item)
                                    @if (old('menu_id' == $item->id))
                                        <option value="{{ $item->id }}" selected>{{ $item->firstname }}</option>
                                    @endif
                                <option value="{{ $item->id }}">{{ $item->firstname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="table_id">Table Number</label>
                            <select name="table_id" id="table_id" class="form-control">
                                <option value="" selected>Select The Table</option>
                                @foreach ($table as $item)
                                    @if (old('menu_id' == $item->id))
                                        <option value="{{ $item->id }}" selected>{{ $item->table_number }}</option>
                                    @endif
                                <option value="{{ $item->id }}">{{ $item->table_number }}</option>
                                @endforeach
                            </select>
                        </div>
                            <div class="form-group">
                            <label for="payment_method">Payment Method</label>
                            <input type="text" class="form-control form-control-user" id="payment_method" value="{{ old('payment_method') }}" name="payment_method" placeholder="Enter Payment Method">
                        </div>
                        <div class="form-group">
                            <label for="quantity">Item Quantity</label>
                            <input type="number" class="form-control form-control-user" id="quantity" value="{{ old('quantity') }}" name="quantity" placeholder="Enter Item Quantity">
                        </div>
                        <div class="form-group">
                            <label for="price">Menu Price</label>
                            <input type="number" class="form-control form-control-user" id="price" value="{{ old('price') }}" name="price" placeholder="Enter Menu Price">
                        </div>
                        <div class="form-group">
                            <label for="detail">Order Detail</label>
                            <textarea name="detail" id="detail" class="form-control" rows="4" aria-valuenow="{{ old('detail') }}"></textarea>
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


<div class="modal fade" id="updateOrderModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="userModalLabel">Create User</h5>
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
                            <label for="menu_id">Menu</label>
                            <select name="menu_id" id="edit_menu_id" class="form-control">
                                <option value="" selected>Select The Menu</option>
                                @foreach ($menu as $item)
                                    @if (old('menu_id' == $item->id))
                                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                    @endif
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user_id">User</label>
                            <select name="user_id" id="edit_user_id" class="form-control">
                                <option value="" selected>Select The User</option>
                                @foreach ($user as $item)
                                    @if (old('menu_id' == $item->id))
                                        <option value="{{ $item->id }}" selected>{{ $item->firstname }}</option>
                                    @endif
                                <option value="{{ $item->id }}">{{ $item->firstname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="table_id">Table Number</label>
                            <select name="table_id" id="edit_table_id" class="form-control">
                                <option value="" selected>Select The Table</option>
                                @foreach ($table as $item)
                                    @if (old('menu_id' == $item->id))
                                        <option value="{{ $item->id }}" selected>{{ $item->table_number }}</option>
                                    @endif
                                <option value="{{ $item->id }}">{{ $item->table_number }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="payment_method">Payment Method</label>
                            <input type="text" class="form-control form-control-user" id="edit_payment_method" value="{{ old('payment_method') }}" name="payment_method" placeholder="Enter Payment Method">
                        </div>
                        {{-- <div class="form-group">
                            <label for="order_code">Order Code</label>
                            <input type="text" class="form-control form-control-user" id="edit_order_code" value="{{ old('order_code') }}" name="order_code" placeholder="Enter Payment Method">
                        </div> --}}
                        <div class="form-group">
                            <label for="quantity">Item Quantity</label>
                            <input type="number" class="form-control form-control-user" id="edit_quantity" value="{{ old('quantity') }}" name="quantity" placeholder="Enter Item Quantity">
                        </div>
                        <div class="form-group">
                            <label for="price">Menu Price</label>
                            <input type="number" class="form-control form-control-user" id="edit_price" value="{{ old('price') }}" name="price" placeholder="Enter Menu Price">
                        </div>
                        <div class="form-group">
                            <label for="detail">Order Detail</label>
                            <textarea name="detail" id="edit_detail" class="form-control" rows="4" aria-valuenow="{{ old('detail') }}"></textarea>
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
        let getData = id => {
            fetch(`orders/${id}`).then(response => response.json()).then(response => {
                document.getElementById("edit_form").action = `orders/${id}`
                document.getElementById("edit_menu_id").value = response.menu_id;
                document.getElementById("edit_table_id").value = response.table_id;
                document.getElementById("edit_user_id").value = response.user_id;
                document.getElementById("edit_payment_method").value = response.payment_method;
                document.getElementById("edit_price").value = response.price;
                document.getElementById("edit_quantity").value = response.quantity;
                document.getElementById("edit_detail").value = response.detail;
            });
        }
    </script>
@endsection

@endsection
