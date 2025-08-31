@extends('admin.layout.main')
@section('title', 'Edit sizes')
@section('content')
    <div class="p-4">
        <h4>Edit size</h4>
        <form action="{{ route('admin.size.update', [$size->id]) }}" method="post" enctype="multipart/form-data">
            @csrf

            <x-admin.input name="name" label="Size Name" type="text" :oldvalue="$size->name"/>


            <div class="mt-5">
                <input type="submit" value="Update" class="btn btn-success px-4 py-2 ">
            </div>
        </form>
    </div>

@endsection
