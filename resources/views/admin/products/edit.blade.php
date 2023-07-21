@extends('admin.layout')

@section('page_title')
    Update Product
    <a href="{{ route('dashboard.products.index') }}" class="link">Back</a>
@endsection

@section('sub')
    products
@endsection
@section('content')
    <div class="container col-md-10">
        <x-alert />
        <form action="{{ route('dashboard.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            {{-- name --}}
            <div class="form-group">
                <x-form.lable>Name</x-form.lable>
                <x-form.input name='name' type="text" class="form-control" :value="$product->name" />
            </div>
            {{-- Description --}}
            <div class="form-group">
                <x-form.lable>Description</x-form.lable>
                <x-form.input name='description' type="text" class="form-control" :value="$product->description" />
            </div>
            {{-- price --}}
            <div class="form-group">
                <x-form.lable>Price</x-form.lable>
                <x-form.input name='price' type="number" class="form-control" :value="$product->price" />
            </div>
            {{-- compare price --}}
            <div class="form-group">
                <x-form.lable>Compare Price</x-form.lable>
                <x-form.input name='compare_price' type="number" class="form-control" :value="$product->compare_price" />
            </div>
            {{-- tags --}}
            <div class="form-group">
                <x-form.lable>Tags</x-form.lable>
                <x-form.input name='tags' :value="$tags" type="text" class="form-control" />
            </div>

            {{-- image --}}
            <div class="form-group">
                <x-form.lable>Image</x-form.lable>
                <x-form.input name='image' type="file" class="form-control" />
            </div>
            {{-- store --}}
            <div class="form-group">
                <label for="store_id">Store</label>
                <select name="store_id" id="store_id" class="form-control">
                    <option :value="$product->store_id" selected>{{ $product->store->name }}</option>
                    @foreach ($stores as $store)
                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- category --}}
            <div class="form-group">
                <x-form.lable>Category</x-form.lable>
                <select name="category_id" id="category_id" class="form-control">
                    <option :value="$product->category->id" selected>{{ $product->category->name }}</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- status --}}
            <div class="form-group">
                <x-form.lable>Status</x-form.lable>
                <div class="form-check">
                    <input class="form-chek-input" type="radio" name="status" id="active" value="active" checked>
                    <label class="form-chek-lable" for="active">active</label>
                </div>
                <div class="form-check">
                    <input class="form-chek-input" type="radio" name="status" id="archived" value="archived">
                    <label class="form-chek-lable" for="archived">archived</label>
                </div>
                <div class="form-check">
                    <input class="form-chek-input" type="radio" name="status" id="draft" value="draft">
                    <label class="form-chek-lable" for="draft">draft</label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit </button>
            </div>

        </form>
    </div>
@endsection
