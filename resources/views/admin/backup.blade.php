@extends('layouts.admin')
@section('container')


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ asset('administrator/backup/create') }}">
            <button type="button" class="btn btn-danger mx-4" data-toggle="modal" data-target="#createCategoryModal">
                <i class="fas fa-save"></i>
                <span>Backup</span>
            </button>
        </a>
    </div>
    <div class="card-body">
        <div class="table-wrapper">
            <div class="md-card-content" style="overflow-x: auto;">
                <table class="table table-bordered table-striped table-hover">
                    @if ($data->count())
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">File Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $i => $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item["filename"] }}</td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{ asset("administrator/backup?download=$i") }}">
                                        <button type="submit" class="btn btn-primary mr-4">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    </a>
                                    <form action="{{ asset("administrator/backup/delete/$i") }}" method="POST" class="mx-3">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
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
            {{-- {{ $dataArr->links() }} --}}
        </div>
    </div>
</div>


@endsection
