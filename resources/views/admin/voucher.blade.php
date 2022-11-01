@extends('layouts.admin')
@section('container')


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button type="button" class="btn btn-danger mx-3" data-toggle="modal" data-target="#createVoucherModal">
            <i class="fas fa-plus"></i>
            <span>Create</span>
        </button>
    </div>
    <div class="card-body">
        <div class=" d-flex justify-content-between flex-column flex-md-row">
            <div class="col-md-3 ">
                <form action="{{ asset('vouchers') }}" method="GET" class="d-block mb-2">
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
                <form action="{{ asset('vouchers') }}" method="GET">
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
                            <th>Voucher Name</th>
                            <td>Voucher Code</td>
                            <th>Expired</th>
                            <th>Voucher Type</th>
                            <th>Amount</th>
                            <th>Limit</th>
                            <th>minimal Purchase</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataArr as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->code }}</td>
                                <td>{{ $data->expired }}</td>
                                <td>{{ $data->type }}</td>
                                <td>{{ $data->amount }}</td>
                                <td>{{ $data->limit}}</td>
                                <td>@money($data->minPurchase)</td>
                                <td>{{ $data->description}}</td>
                                <td class="d-flex justify-content-center">
                                    <button type="button"  onclick="getData({{ $data->id }})" class="btn btn-warning" data-toggle="modal" data-target="#updateVoucherModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="/vouchers/{{ $data->id }}" method="POST" class="mx-3">
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
                            <th>Voucher Name</th>
                            <td>Voucher Code</td>
                            <th>Expired</th>
                            <th>Voucher Type</th>
                            <th>Amount</th>
                            <th>Limit</th>
                            <th>minimal Purchase</th>
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


<div class="modal fade" id="createVoucherModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="userModalLabel">Create Voucher</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ asset('vouchers') }}" method="post">
                @csrf
                <div class="form-group">
                    <div class="form-group">
                        <label for="name">Voucher Name</label>
                        <input type="text" class="form-control form-control-user" id="name" value="{{ old('name') }}" name="name"
                        placeholder="Enter Voucher Name">
                    </div>
                        <div class="form-group">
                        <label for="expired">Expired</label>
                        <input type="datetime-local" name="expired" class="form-control form-control-user" id="expired" value="{{ old('expired') }}">
                    </div>
                    <div class="form-group">
                        <label for="type">Voucher Type</label>
                        <input type="text" class="form-control form-control-user" id="type" value="{{ old('type') }}" name="type" placeholder="Voucher Type">
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" class="form-control form-control-user" id="amount" value="{{ old('amount') }}" name="amount" placeholder="Voucher Amount">
                    </div>
                    <div class="form-group">
                        <label for="limit">Limit Quantity</label>
                        <input type="text" class="form-control form-control-user" id="limit" value="{{ old('limit') }}" name="limit"
                        placeholder="Enter Voucher Limit">
                    </div>
                    <div class="form-group">
                        <label for="minPurchase">Minimal Purchase</label>
                        <input type="text" class="form-control form-control-user" id="minPurchase" value="{{ old('minPurchase') }}" name="minPurchase"
                        placeholder="Voucher Minimal Purchase">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" rows="4" placeholder="Enter Voucher Description" aria-valuenow="{{ old('description') }}" class="form-control"></textarea>
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

<div class="modal fade" id="updateVoucherModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="userModalLabel">Create Voucher</h5>
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
                        <label for="name">Voucher Name</label>
                        <input  type="text" class="form-control form-control-user" id="edit_name" value="{{ old('name') }}" name="name"
                        placeholder="Enter Voucher Name">
                    </div>
                    <div class="form-group">
                        <label for="code">Voucher Code</label>
                        <input  type="text" class="form-control form-control-user" id="edit_code" value="{{ old('code') }}" name="code"
                        placeholder="Enter Voucher Code" disabled>
                        <label for="code" class="mt-3 text-small text-muted">
                            <input type="checkbox" id="enable">
                            If you want to edit this Code check this
                        </label>
                    </div>
                        <div class="form-group">
                        <label for="expired">Expired</label>
                        <input  type="datetime-local" name="expired" class="form-control form-control-user" id="edit_expired" value="{{ old('expired') }}">
                    </div>
                    <div class="form-group">
                        <label for="type">Voucher Type</label>
                        <input  type="text" class="form-control form-control-user" id="edit_type" value="{{ old('type') }}" name="type" placeholder="Voucher Type">
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input  type="number" class="form-control form-control-user" id="edit_amount" value="{{ old('amount') }}" name="amount" placeholder="Voucher Amount">
                    </div>
                    <div class="form-group">
                        <label for="limit">Limit Quantity</label>
                        <input  type="text" class="form-control form-control-user" id="edit_limit" value="{{ old('limit') }}" name="limit"
                        placeholder="Enter Voucher Limit">
                    </div>
                    <div class="form-group">
                        <label for="minPurchase">Minimal Purchase</label>
                        <input  type="text" class="form-control form-control-user" id="edit_minPurchase" value="{{ old('minPurchase') }}" name="minPurchase"
                        placeholder="Voucher Minimal Purchase">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="edit_description" rows="4" placeholder="Enter Voucher Description" aria-valuenow="{{ old('description') }}" class="form-control"></textarea>
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
            fetch(`vouchers/${id}`).then(response => response.json()).then(response => {
                document.getElementById("edit_form").action = `vouchers/${id}`
                document.getElementById("edit_name").value = response.name;
                document.getElementById("edit_code").value = response.code;
                document.getElementById("edit_expired").value = response.expired;
                document.getElementById("edit_type").value = response.type;
                document.getElementById("edit_amount").value = response.amount;
                document.getElementById("edit_limit").value = response.limit;
                document.getElementById("edit_minPurchase").value = response.minPurchase;
                document.getElementById("edit_description").value = response.description;
            });
        }

        $(function(){
            $("#enable").click(function(){
                if($(this).is(":checked")){
                    $("#edit_code").removeAttr("disabled");
                    $("#edit_code").focus();
                }else{
                    $("#edit_code").attr("disabled", "disabled");
                }
            })
        })
</script>

@endsection

@endsection
