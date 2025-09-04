@extends('admin.layout.main')
@section('title', 'Orders')

@section('actions')
@endsection

@section('content')
    <x-admin.table
        :values="$orders"
        view_route="admin.order.show"
        status_route="admin.orders.updateStatus"
        :edit_route="null"
        :delete_route="null"
        :hidden_field="['id', 'updated_at', 'payment_id', 'shipping_address_id']"
        view_mode="link"
        :custom_columns="[
        'user.name' => 'Customer Name',
        'total_amount' => 'Total Amount',
        'status' => 'Order Status',
        'created_at' => 'Order Date'
    ]"
    />

@endsection
