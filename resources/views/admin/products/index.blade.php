@extends('admin.layout')

@section('page_title')
    All Products
    <a href="{{ route('dashboard.products.create') }}" class="btn btn-outline-primary">Create</a>
@endsection

@section('sub')
    Products
@endsection
@section('content')
    <div class="container">

        {{-- search input --}}
        <div class="col-md-12">
            <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between">
                {{-- @csrf --}}
                <x-form.input typy='search' value="{{ old('name') }}" name='name' class="form-control col-md-12 " placeholder='search name' />
                <select name="status" class="form-control col-md-3" id="">
                    <option value="">All</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                <button class="btn btn-dark" type="submit">Filter</button>
            </form>
        </div>
        {{-- alert --}}
        <x-alert />
        {{-- table --}}
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>image</th>
                    <th>Status</th>
                    <th>Category</th>
                    <th>Store</th>
                    <th>Created At</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>

                @forelse($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->name }}</td>
                        <td><img src='{{ asset("storage/$product->image ") }}' width="50px" height="50px"></td>
                        <td>{{ $product->status }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->store->name }}</td>
                        <td>{{ $product->created_at }}</td>
                        <td>
                            <div class="d-flex">
                                <a class="btn btn-primary mr-2"
                                    href="{{ route('dashboard.products.edit', [$product->id]) }}">Edit</a>
                                <form action='{{ url("dashboard/products/$product->id") }}' method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger" type="submit"> Delete </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9"> No products Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{-- paginate --}}
        <hr>              
          {{ $products->withQueryString()->links() }}
    </div>
@endsection
