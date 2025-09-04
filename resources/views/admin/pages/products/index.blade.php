@extends('admin.layout.main')
@section('title', 'Products')

@section('actions')
    <x-admin.modal-add-form name="addProduct" title="Add Product">
        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Category --}}
            <x-admin.select-input name="category_id" label="Product Category" :values="$categories" />

            {{-- Product Name --}}
            <x-admin.input name="name" label="Product Name" type="text" />

            {{-- Product Price --}}
            <x-admin.input name="price" label="Product Price" type="number" />

            {{-- Product Stock --}}
            <x-admin.input name="stock" label="Product Stock" type="number" />

            {{-- Main Image --}}
            <div class="mb-3">
                <x-admin.input name="main_image" label="Main Product Image" type="file" />
            </div>

            {{-- Colors --}}
            <x-admin.select-input name="colors" label="Available Colors" :values="$colors" :multiple="true"
                displayColumn="name" :oldValue="old('colors', [])" />

            {{-- Sizes --}}
            <x-admin.select-input name="sizes" label="Available Sizes" :values="$sizes" :multiple="true"
                displayColumn="name" :oldValue="old('sizes', [])" />

            {{-- Description --}}
            <div class="mb-3">
                <label for="description" class="form-label fw-bold">Product Description</label>
                <textarea class="form-control" name="description" id="description" placeholder="Enter description..." rows="6">{{ old('description') }}</textarea>
            </div>

            {{-- Submit --}}
            <div class="d-flex justify-content-end">
                <input type="submit" value="Add Product" class="btn btn-success px-4 py-2">
            </div>
        </form>
    </x-admin.modal-add-form>
@endsection


@section('content')
    <x-admin.table :values="$products" edit_route="admin.product.edit" view_route="admin.product.show"
        delete_route="admin.product.destroy" :hidden_field="['id', 'slug', 'created_at', 'updated_at', 'extra', 'avatar', 'social_links']" />
@endsection
