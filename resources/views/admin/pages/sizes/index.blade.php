@extends('admin.layout.main')
@section('title', 'Sizes')

@section('actions')
    <x-admin.modal-add-form name="addSizes" title="Add Sizes">

        <form action="{{ route('admin.size.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <x-admin.input name="name" label="Size Name" type="text" />
            <div class="mt-5">
                <input type="submit" value="Add" class="btn btn-success px-4 py-2 ">
            </div>
        </form>

    </x-admin.modal-add-form>
@endsection

@section('content')



    <x-admin.table :values="$sizes" edit_route="admin.size.edit" view_route="admin.size.show" delete_route="admin.size.destroy"
                   :hidden_field="['id', 'slug', 'created_at', 'updated_at','extra','image']"  />

@endsection
