@extends('admin.layout.main')
@section('title', 'Add categories')
@section('content')
    <div class="p-4">

        <h4>Add question</h4>
        <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
            @csrf
{{--            <x-admin.input name="name" label="categories Name" placeholder="Enter categories Name" />--}}


            <p class="mt-3">Question</p>
            <textarea class="form-control" name="question" id="description" placeholder="Enter question" rows="15">{{ old('categories') }}</textarea>

            <x-admin.input name="image[]" label="Select Image" multiple type="file" placeholder="Select Image" />

            <div class="mt-5">
                <input type="submit" value="Add" class="btn btn-success px-4 py-2 ">
            </div>
        </form>
    </div>

@endsection
