@extends('web.web')
@section('content')
<main id="main">
    <section class="hero d-flex align-items-center section-bg">
        <div class="container">
            <div class="row justify-content-between gy-5">
                <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center align-items-lg-start text-center text-lg-start">
                        <h2 data-aos="fade-up">Enjoy Your Healthy<br>Delicious Food</h2>
                        <p data-aos="fade-up" data-aos-delay="100">Sed autem laudantium dolores. Voluptatem itaque ea consequatur eveniet. Eum quas beatae cumque eum quaerat.</p>
                    <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                        <a href="#book-a-table" class="btn-book-a-table">Book a Table</a>
                        <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
                    </div>
                </div>
                <div class="col-lg-5 order-1 order-lg-2 text-center text-lg-start">
                    <img src="{{ asset('assets/img/hero-img.png') }}" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="300">
                </div>
            </div>
        </div>
    </section>

    <section >
        <div data-aos="fade-up">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title text-center">
                            <h1>Enter Your Order Here</h1>
                        </div>
                        <form action="{{ asset('/home/order') }}" method="POST">
                            @csrf
                            <div class="my-3 row g-3 col-xl-7 mx-auto">
                                <div class="col-md-6">
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
                                <div class="col-md-6">
                                    <select name="table_id" id="table_id" class="form-control">
                                        <option selected>Select The Table</option>
                                        @foreach ($table as $item)
                                            @if (old('menu_id' == $item->id))
                                                <option value="{{ $item->id }}" selected>{{ $item->table_number }}</option>
                                            @endif
                                        <option value="{{ $item->id }}">{{ $item->table_number }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <select name="payment_method" id="payment_method" class="form-control">
                                        <option selected >Select The Payment Method</option>
                                        <option value="bank">Bank</option>
                                        <option value="e-wallet">E-Wallet</option>
                                        <option value="cash">Cash</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <input type="number" class="form-control form-control-user" id="quantity" value="{{ old('quantity') }}" name="quantity" placeholder="Enter Item Quantity">
                                </div>
                                {{-- <div class="col-md-6" id="menu_price">
                                    @foreach ($menu as $item)
                                    <input type="number" class="form-control form-control-user" id="price" value="{{ $item->price }}" name="price" readonly disabled>
                                    @endforeach
                                </div> --}}
                                <div class="col-12">
                                    <textarea name="detail" id="detail" class="form-control" rows="4" aria-valuenow="{{ old('detail') }}" placeholder="Order Detail"></textarea>
                                </div>
                            </div>
                            <div class="vstack gap-2 col-md-5 mx-auto">
                                <button type="submit" class="w-56 btn btn-danger">Order</button>
                                {{--
                                    <a href="{{ asset('/home') }}">
                                        <button type="submit" class="w-56 btn btn-danger">back</button>
                                    </a>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control form-control-user" id="price" value="{{ old('price') }}" name="price" placeholder="Enter Menu Price">
                                    </div>
                                --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
