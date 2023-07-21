@extends('admin.layout')

@section('page_title')
    Create Product
    <a href="{{ route('dashboard.products.index') }}" class="link">Back</a>
@endsection

@section('sub')
    Products
@endsection
@section('content')
    <div class="container col-md-8">
        <x-alert />

        <form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Product Name</label>
                <x-form.input name='name' class="form-control" />
            </div>
            <div class="form-group">
                <label for="parent_id">Product Parent</label>
                <select name="parent_id" id="" class="form-control">
                    <option value="">Parent Category</option>
                    @foreach ($parents as $parent)
                        <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="description">Product Description</label>
                <textarea class="form-control no-resize" type="text" name="description" rows="5"></textarea>
            </div>

            <div class="form-group">
                <x-form.lable>Product logo</x-form.lable>
                <x-form.input name='logo' type="file" class="form-control" />
            </div>
            <div class="form-group">
                <label for="">Status </label>
                <div class="form-check">
                    <label class="form-chek-lable" for="Active">Active</label>
                    <input class="form-chek-input" type="radio" name="status" id="Active" value="active">
                </div>
                <div class="form-check">
                    <label class="form-chek-lable" for="Inactive">Inactive</label>
                    <input class="form-chek-input" type="radio" name="status" id="Inactive" value="inactive">
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit </button>
            </div>

        </form>
    </div>
@endsection
