@extends('admin.layout.main')
@section('title', 'Categories')

@section('actions')
    <x-admin.modal-add-form name="addCategories" title="Add Categories">

        <form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <x-admin.input name="name" label="Category Name" type="text" />
            <div class="mt-5">
                <input type="submit" value="Add" class="btn btn-success px-4 py-2 ">
            </div>
        </form>

    </x-admin.modal-add-form>
@endsection

@section('content')



    <x-admin.table :values="$categories" edit_route="admin.category.edit" view_route="admin.category.show" delete_route="admin.category.destroy"
                   :hidden_field="['id', 'slug', 'created_at', 'updated_at','extra','image']"  />

@endsection
