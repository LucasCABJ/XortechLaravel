@extends('layouts.app')

@section('title', 'Purchase Order Details')

@section('content')
    @component('components.navbar')
    @endcomponent
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Order Details</h1>
                <p><strong>Order Number:</strong> {{ $purchaseOrder->order_number }}</p>
                <p><strong>Total:</strong> ${{ $purchaseOrder->total }}</p>
                <p><strong>Status:</strong> {{ $purchaseOrder->status }}</p>
                <p><strong>Created At:</strong> {{ $purchaseOrder->created_at }}</p>

                <h2>Sales</h2>
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
                    @foreach ($purchaseOrder->sales as $sale)
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
        </div>
    </div>
@endsection
