@extends('web.web')
@section('content')
<main id="main">
    <section>
        @if ($dataArr->count())
        <div class="mt-3 text-center">
            <h1>My Order</h1>
        </div>
            <div class="container d-flex mt-3">
                @foreach ($dataArr as $item)
                    <div class="card mx-3" style="width: 18rem;">
                        <img src="{{ asset( $item->menu->image) }}" class="card-img-top w-100" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->menu->name }}</h5>
                            <div class="btn-group mb-3" role="group">
                                <div class="card-text btn btn-info">Code : {{ $item->order_code }}</div>
                                <div class="card-text btn btn-info">Quantity : {{ $item->quantity }}</div>
                            </div>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <h4 class="btn btn-primary">Price : @money($item->menu->price)</h4>
                                <h4 class="btn btn-primary">Total : @money($item->total_pay) </h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="mt-3 text-center">
                <h1>Opss</h1>
            </div>
            <div class="d-flex align-items-center justify-content-center mt-5">
                <div class="text-center">
                    <div class="card border-secondary mb-3" style="max-width: 20rem;">
                        <div class="card-header">Dear {{ auth()->user()->name }}</div>
                        <div class="card-body text-secondary">
                            <h5 class="card-title">Sorry, you don't have any orders yet</h5>
                            <p class="card-text">
                                please order the menu in advance <a href="{{ asset('/home/order') }}">here</a>, if you want to see the menu available in this restaurant <a href="/home/menu">click here</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>
</main>
@endsection
