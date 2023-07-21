@extends('admin.layout')

@section('page_title')
    Categories/{{ $category->name }}
@endsection

@section('sub')
    Categories /{{ $category->name }}
@endsection
@section('content')
    <div class="container">


        {{-- alert --}}
        <x-alert />

                {{-- table --}}
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Store</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $products = $category->products()->with('store')->latest()->paginate(6) 
                @endphp
                @forelse($products as $product )
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->store->name }}</td>
                        <td>{{ $product->status }}</td>
                        <td>{{ $product->created_at }}</td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5"> No Products Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <hr>              
            {{ $products->withQueryString()->links() }}
    </div>
@endsection
