@extends('admin.layout.main')
@section('title', 'Edit colors')
@section('content')
    <div class="p-4">
        <h4>Edit color</h4>
        <form action="{{ route('admin.color.update', [$color->id]) }}" method="post" enctype="multipart/form-data">
            @csrf

            <x-admin.input name="name" label="Color Name" type="text" :oldvalue="$color->name"/>
            <x-admin.input name="hex_value" label="Hex value" type="text" :oldvalue="$color->hex_value"/>


            <div class="mt-5">
                <input type="submit" value="Update" class="btn btn-success px-4 py-2 ">
            </div>
        </form>
    </div>

@endsection
