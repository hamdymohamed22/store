@extends('admin.layout')

@section('page_title')
    All Categories
    <a href="{{ route('dashboard.categories.create') }}" class="btn btn-outline-primary">Create</a>
@endsection

@section('sub')
    Categories
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
                    <th>Logo</th>
                    <th>Status</th>
                    <th>Products Count</th>
                    <th>Parent</th>
                    <th>Created At</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- @if ($categories->count() > 0) --}}
                @forelse($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{ route('dashboard.categories.show' , $category->id) }}">
                            {{ $category->name }}</a></td>
                        <td><img src='{{ asset("storage/$category->logo ") }}' width="50px" height="50px"></td>
                        <td>{{ $category->status }}</td>
                        <td>{{ $category->have_products }}</td>
                        {{-- <td>{{ $category->parent ? $category->parent->name : 'Main Category' }}</td> --}}
                        <td>{{ $category->parent->name }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td>
                            <div class="d-flex">
                                <a class="btn btn-primary mr-2"
                                    href="{{ route('dashboard.categories.edit', [$category->id]) }}">Edit</a>
                                <form action='{{ url("dashboard/categories/$category->id") }}' method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger" type="submit"> Delete </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7"> No Categories Find</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{-- paginate --}}
        <hr>              
          {{ $categories->withQueryString()->links() }}
    </div>
@endsection
