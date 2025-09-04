@extends('admin.layout.main')
@section('title', 'Colors')

@section('actions')
    <x-admin.modal-add-form name="addColors" title="Add Colors">

        <form action="{{ route('admin.color.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <x-admin.input name="name" label="Color Name" type="text" />
            <x-admin.input name="hex_value" label="Hex value" type="text" />
            <div class="mt-5">
                <input type="submit" value="Add" class="btn btn-success px-4 py-2 ">
            </div>
        </form>

    </x-admin.modal-add-form>
@endsection

@section('content')



    <x-admin.table :values="$colors" edit_route="admin.color.edit" view_route="admin.color.show" delete_route="admin.color.destroy"
                   :hidden_field="['id', 'slug', 'created_at', 'updated_at','extra','image']"  />

@endsection
