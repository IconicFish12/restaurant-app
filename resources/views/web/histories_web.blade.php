@extends('web.web')
@section('content')
<main id="main">
    <section>
        <div class="mt-3 text-center">
            <h1>My Order</h1>
        </div>
        <div class="container col-md-7 d-flex justify-content-between mt-3">
            @foreach ($dataArr as $item)
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset( $item->menu->image) }}" class="card-img-top w-100" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->menu->name }}</h5>
                        <div class="d-flex justify-content-between my-3">
                            <div class="card-text btn btn-info">Order Code : {{ $item->order_code }}</div>
                            <div class="card-text btn btn-info">Order Quantity : {{ $item->quantity }}</div>
                        </div>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <h4 class="btn btn-primary">Price : @money($item->menu->price)</h4>
                            <h4 class="btn btn-primary">Total : @money($item->total_pay) </h4>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</main>
@endsection
