@extends('admin.layout')

@section('page_title')
    Trashed Categories
@endsection

@section('sub')
    Categories
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
                    <th>Logo</th>
                    <th>Status</th>
                    <th>Parent</th>
                    <th>Deleted At</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- @if ($categories->count() > 0) --}}
                @forelse($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->name }}</td>
                        <td><img src='{{ asset("storage/$category->logo ") }}' width="50px" height="50px"></td>
                        <td>{{ $category->status }}</td>
                        <td>{{ $category->parent_name }}</td>
                        <td>{{ $category->deleted_at }}</td>
                        <td>
                            <div class="d-flex justify-content-between">
                                <form action='{{ route("categories.forceDelete" ,$category->id) }}' method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger" type="submit"> Delete </button>
                                </form>
                                <form action='{{ route("categories.restore",$category->id) }}' method="post">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-outline-primary" type="submit"> Restore </button>
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
