<x-front-layout title="Cart">
    {{-- breadcrumbs --}}
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Cart</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('front.home') }}"><i class="lni lni-home"></i> Home</a></li>
                        <li><a href="{{ route('front.products.index') }}"><i class="lni lni-store"></i> Shop</a></li>
                        <li><a href="$"><i class="lni lni-home"></i> Cart</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <x-alert />
    <div class="card card-solid pb-5 mb-5">
        <div class="card-body pb-0">
            <div class="row">

                @forelse ($items as $item)
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column mb-4">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">
                                Digital Strategist
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7">
                                        <a href="{{ route('front.products.show', $item->product->slug) }}"
                                            class="lead">
                                            <b>{{ $item->product->name }}</b></a>
                                        <p class="text-muted text-sm"><b>About:{{ $item->product->description }} </b>
                                        </p>
                                    </div>
                                    <div class="col-5 text-center">
                                        <a href="{{ route('front.products.show', $item->product->slug) }}">
                                            <img src="{{ $item->product->image_url }}" alt="user-avatar"
                                                class="img-circle img-fluid">
                                        </a>
                                    </div>
                                    <div class="count-input ">
                                        <form action="{{ route('front.cart.update', $item->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type='number' name="quantity" class="form-control" max="10"
                                                min="1" value="{{ $item->quantity }}">
                                            <div class="d-flex justify-content-between align-items-stretch">
                                                <button class="btn btn-outline-primary mt-1" type="submit">reset
                                                    quantity</button>
                                                <p class="fw-bold c-black">Subtotal:
                                                    {{ Currency::format($item->quantity * $item->product->price) }}</p>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <form action="{{ route('front.cart.destroy', $item->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="mx-auto">
                        <h3 class="text-center text-capitalize">no carts</h3>
                    </div>
                @endforelse
                <h3> Total: {{ Currency::format($total) }}</h3>
            </div>
        </div>
    </div>

</x-front-layout>
