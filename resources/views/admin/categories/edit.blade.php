@extends('admin.layout')

@section('page_title')
    Update Categories
    <a href="{{ route('dashboard.categories.index') }}" class="link">Back</a>
@endsection

@section('sub')
    Categories
@endsection

@section('content')
    <div class="container col-md-10">
                <x-alert />
        <form action="{{ route('dashboard.categories.update', [$category->id]) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">Category Name</label>
                <input class="form-control" value="{{ $category->name }}" type="text" name="name" id="">
            </div>
            <div class="form-group">
                <label for="parent_id">Category Parent</label>
                <select name="parent_id" id="" class="form-control">
                    <option value="">Parent Category</option>
                    @foreach ($parents as $parent)
                        <option value="{{ $parent->id }}" @selected("$category->parent_id , $parent->id")>{{ $parent->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="description">Category Description</label>
                <textarea class="form-control no-resize" type="text" name="description" rows="5">{{ $category->name }}</textarea>
            </div>


            <div class="form-group">
                <label for="logo">Category logo</label>
                <input class="form-control" type="file" name="logo" id="">
            </div>
            <div class="cart">
                <img src='{{ asset("storage/$category->logo") }}' alt="" width="100px" height="100px">
            </div>
            <div class="form-group">
                <label for="">Status </label>
                <div class="form-check">
                    <input class="form-chek-input" type="radio" name="status" id="status" value="active" checked>
                    <label class="form-chek-lable" for="status">Active</label>
                </div>
                <div class="form-check">
                    <input class="form-chek-input" type="radio" name="status" id="status" value="inactive">
                    <label class="form-chek-lable" for="status">Inactive</label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit </button>
            </div>

        </form>
    </div>
@endsection
