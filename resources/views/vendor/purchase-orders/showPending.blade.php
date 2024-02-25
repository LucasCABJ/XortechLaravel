@extends('layouts.app')

@section('title', 'Purchase Order Details')

@section('content')
    @component('components.navbar')
    @endcomponent
    <div class="container">
        <div class="row my-3">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="my-3">Order Details</h1>
                    </div>
                    <div class="col-md-6">

                        <h2 class="mt-4 text-end">{{ $pendingOrder->order_number }}</h2>
                    </div>
                </div>
                <div class="border px-2">
                    <h4 class="my-3">Details</h4>
                    <p><strong>Order Number:</strong> {{ $pendingOrder->order_number }}</p>
                    <p><strong>Total:</strong> ${{ $pendingOrder->total }}</p>
                    <p><strong>Status:</strong> {{ $pendingOrder->status }}</p>
                    <p><strong>Created At:</strong> {{ $pendingOrder->created_at }}</p>
                </div>

                <h2 class="my-3">Sales</h2>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($pendingOrder->sales as $sale)
                        <tr>
                            <td>{{ $sale->product->name }}</td>
                            <td>${{ $sale->sale_price }}</td>
                            <td>{{ $sale->quantity }}</td>
                            <td>${{ $sale->subtotal() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <a class="mb-5 mt-2" href=" {{ route('vendor.purchase-orders.pending') }}">Go Back</a>
        </div>
    </div>
@endsection
