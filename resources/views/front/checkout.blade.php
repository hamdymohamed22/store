<x-front-layout>
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">cart</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('front.home') }}"><i class="lni lni-home"></i> Home</a></li>
                        <li><a href="{{ route('front.home') }}">Shop</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between">
        <section class="content mt-5 mb-5 col-md-8">
            <div class="container-fluid">
                <div class="row">
                    <form action="{{ route('front.checkout.store') }}" method="post">
                        @csrf
                        <div class="col-md-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Checkout Billing</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">First Name</label>
                                        <x-form.input type="text" name='address[billing][first_name]'
                                            class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Last Name</label>
                                        <x-form.input type="text" name='address[billing][last_name]'
                                            class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <x-form.input type="email" name='address[billing][email]'
                                            class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Phone</label>
                                        <x-form.input type="text" name='address[billing][phone]'
                                            class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Street Address</label>
                                        <x-form.input type="text" name='address[billing][str_address]'
                                            class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">City</label>
                                        <x-form.input type="text" name='address[billing][city]'
                                            class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Postal Code</label>
                                        <x-form.input type="text" name='address[billing][postal_code]'
                                            class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">State</label>
                                        <x-form.input type="text" name='address[billing][state]'
                                            class="form-control" />
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="country">Country</label>
                                        <select name="address[billing][country]" id="country" class="form-control">
                                            @foreach ($countries as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                           
                            </div>
                        </div>
                        {{-- <div class="col-md-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Checkout Shipping</h3>
                                </div>
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">First Name</label>
                                        <x-form.input type="text" name='address[shipping][first_name]'
                                            class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Last Name</label>
                                        <x-form.input type="text" name='address[shipping][last_name]'
                                            class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <x-form.input type="email" name='address[shipping][email]'
                                            class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Phone</label>
                                        <x-form.input type="text" name='address[shipping][phone]'
                                            class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Street Address</label>
                                        <x-form.input type="text" name='address[shipping][str_address]'
                                            class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">City</label>
                                        <x-form.input type="text" name='address[shipping][city]'
                                            class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Postal Code</label>
                                        <x-form.input type="text" name='address[shipping][postal_code]'
                                            class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">State</label>
                                        <x-form.input type="text" name='address[shipping][state]'
                                            class="form-control" />
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="country">Country</label>
                                        <select name="address[shipping][country]" id="country" class="form-control">
                                            @foreach ($countries as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                        </div> --}}
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <div class="row col-md-4">
            <div class="col-md-12  mt-5 mb-5">
                <div class="col-md-12">
                    <div class="card card-widget widget-user-2">
                        <div class="widget-user-header">
                            <h5 class="title p-2 text-center">Pricing Table</h5>
                        </div>
                        <div class="card-footer p-0">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <h6 class="nav-link">
                                        Subtotal:
                                        <p class="p-2 fw-bold badge bg-danger">
                                            {{ Currency::format($total) }}</p>
                                    </h6>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
        </div>
    </div>
</x-front-layout>
