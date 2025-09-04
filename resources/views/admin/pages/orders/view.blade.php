@extends('admin.layout.main')
@section('title', 'Order Details')

@section('content')
    <div class="container py-5">
        <div class="row">
            {{-- {{ dd($order) }} --}}
            {{-- LEFT SIDE: Order Info --}}
            <div class="col-lg-6 mb-4">
                <div class="border rounded p-3 shadow-sm bg-light h-100">
                    <h5 class="mb-3 d-flex justify-content-between align-items-center">
                        Order #{{ $order->id }}
                        <span
                            class="badge fs-6
                            @if ($order->status == 'pending') bg-warning text-dark
                            @elseif($order->status == 'confirmed') bg-primary
                            @elseif($order->status == 'shipped') bg-info text-dark
                            @elseif($order->status == 'delivered') bg-success
                            @elseif($order->status == 'completed') bg-success
                            @elseif($order->status == 'cancelled') bg-danger
                            @else bg-secondary @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </h5>
                    <p><strong>Order Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
                    <p><strong>Total Amount:</strong> Rs. {{ number_format($order->total_amount, 2) }}</p>


                </div>
            </div>

            {{-- RIGHT SIDE: Payment Info --}}
            <div class="col-lg-6 mb-4">
                <div class="border rounded p-3 shadow-sm bg-light h-100">
                    <h5 class="text-decoration-underline mb-3">Payment Information</h5>
                    @if ($order->payment)
                        <p><strong>Method:</strong> {{ ucfirst($order->payment->payment_method ?? 'N/A') }}</p>
                        <p>
                            <strong>Status:</strong>
                            <span
                                class="badge
                                @if ($order->payment->payment_status == 'paid') bg-success
                                @elseif($order->payment->payment_status == 'pending') bg-warning text-dark
                                @elseif($order->payment->payment_status == 'unpaid') bg-danger
                                @else bg-secondary @endif">
                                {{ ucfirst($order->payment->payment_status ?? 'N/A') }}
                            </span>
                        </p>
                        <p><strong>Amount Paid:</strong> Rs. {{ number_format($order->payment->amount ?? 0, 2) }}</p>
                    @else
                        <p class="text-muted">No payment information available.</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- MIDDLE ROW: Customer + Shipping Info --}}
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="border rounded p-3 shadow-sm h-100">
                    <h5 class="text-decoration-underline">Customer Information</h5>
                    <p><strong>Name:</strong> {{ $order->user->name ?? 'N/A' }}</p>
                    <p><strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}</p>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="border rounded p-3 shadow-sm h-100">
                    <h5 class="text-decoration-underline">Shipping Address</h5>
                    @if ($order->user->shippingAddresses->isNotEmpty())
                        @php $shipping = $order->user->shippingAddresses->first(); @endphp
                        <p><strong>Full Name:</strong> {{ $shipping->full_name }}</p>
                        <p><strong>Phone:</strong> {{ $shipping->phone }}</p>
                        <p><strong>Address Line 1:</strong> {{ $shipping->address_line1 }}</p>
                        <p><strong>City:</strong> {{ $shipping->city }}</p>
                    @else
                        <p class="text-muted">No shipping address available.</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- BOTTOM: Ordered Items --}}
        <div class="border rounded p-3 shadow-sm">
            <h5 class="text-decoration-underline">Ordered Items</h5>
            <div class="table-responsive">
                <table class="table   table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Qty</th>
                            <th>size</th>
                            <th>color</th>
                            <th>Unit Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderItems as $item)
                            <tr>
                                <td>{{ $item->product->name ?? 'N/A' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->productSize->name ?? 'N/A' }}</td>
                                <td>{{ $item->productColor->name ?? 'N/A' }}</td>
                                <td>Rs. {{ number_format($item->price, 2) }}</td>
                                <td>Rs. {{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5" class="text-end">Grand Total:</th>
                            <th>Rs. {{ number_format($order->total_amount, 2) }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
