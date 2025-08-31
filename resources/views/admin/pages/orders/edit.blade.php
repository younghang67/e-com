@extends('admin.layout.main')
@section('title', 'Edit Product')

@section('content')
    <div class="p-4">
        <h4>Edit Product</h4>

        <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf


            {{-- Category --}}
            <x-admin.select-input
                name="category_id"
                label="Product Category"
                :values="$categories"
                :oldValue="old('category_id', $product->category_id)"
            />
            <div class="row">
                {{-- Product Name --}}
                <div class="col-md-6">
                    <x-admin.input name="name" label="Product Name" type="text" :oldvalue="$product->name" />
                </div>

                {{-- Product Price --}}
                <div class="col-md-3">
                    <x-admin.input name="price" label="Product Price" type="number" :oldvalue="$product->price" />
                </div>

                {{-- Product Stock --}}
                <div class="col-md-3">
                    <x-admin.input name="stock" label="Product Stock" type="number" :oldvalue="$product->stock" />
                </div>
            </div>

            {{-- Colors --}}
            <x-admin.select-input
                name="colors"
                label="Available Colors"
                :values="$colors"
                :multiple="true"
                displayColumn="name"
                :oldValue="old('colors', $product->colors->pluck('id')->toArray())"
            />

            {{-- Sizes --}}
            <x-admin.select-input
                name="sizes"
                label="Available Sizes"
                :values="$sizes"
                :multiple="true"
                displayColumn="name"
                :oldValue="old('sizes', $product->sizes->pluck('id')->toArray())"
            />

            {{-- Description --}}
            <div class="mb-3 mt-3">
                <label for="description" class="form-label fw-bold">Product Description</label>
                <textarea
                    class="form-control"
                    name="description"
                    id="description"
                    placeholder="Enter description..."
                    rows="6">{{ old('description', $product->description) }}</textarea>
            </div>

            {{-- Current Image --}}
            <div class="mb-3">
                <p class="fw-bold">Current Main Image</p>
                @if ($product->main_image)
                    <img src="{{ asset('storage/' . $product->main_image) }}" height="150" class="rounded" alt="Product Image">
                @else
                    <p class="text-muted">No image uploaded.</p>
                @endif
            </div>

            {{-- Upload New Image --}}
            <div class="mb-3">
                <x-admin.input name="main_image" label="Upload New Main Image" type="file" />
            </div>

            {{-- Submit --}}
            <div class="mt-4">
                <input type="submit" value="Update Product" class="btn btn-success px-4 py-2">
            </div>
        </form>
    </div>
@endsection
