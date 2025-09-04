@extends('admin.layout.main')
@section('title', 'Edit categories')
@section('content')
    <div class="p-4">
        <h4>Edit category</h4>
        <form action="{{ route('admin.category.update', [$category->id]) }}" method="post" enctype="multipart/form-data">
            @csrf

            <x-admin.input name="name" label="Category Name" type="text" :oldvalue="$category->name"/>


            <div class="mt-5">
                <input type="submit" value="Update" class="btn btn-success px-4 py-2 ">
            </div>
        </form>
    </div>

@endsection
