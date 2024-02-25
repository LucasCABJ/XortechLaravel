@extends('layouts.app')

@section('title', 'Purchases')

@section('headextra')
    @vite(['node_modules/jquery/dist/jquery.min.js'])
@endsection

@section('content')
    @component('components.navbar')
    @endcomponent

    <div class="container mt-4 main" style="min-height: 80vh">


        <h2 class="mt-3">{{ __('My Purchases') }}</h2>

        <table class="table table-responsive table-striped mt-3 table-hover">
            <thead>
            <tr>
                <th class="fw-bold fs-5 ps-3">Identifier</th>
                <th class="fw-bold fs-5 ps-3">Amount</th>
                <th class="fw-bold fs-5 ps-3">Dates</th>
                <th class="fw-bold fs-5 ps-3">Status</th>



            </tr>
            </thead>
            <tbody>
            @forelse ($purchaseOrders as $po)
                <tr>
                    <td>
                        <a href="{{ route('purchase-orders.show', $po->id) }}">
                            {{ $po->order_number }}
                        </a>
                    </td>
                    <td>${{ $po->total }}</td>
                    <td>
                        <div><i class="text-danger fas fa-calendar-alt"></i> {{ $po->created_at }}</div>
                        <div><i class="text-warning-emphasis fas fa-shipping-fast"></i> {{ $po->shipped_at }}</div>
                        <div><i class="text-success fas fa-check-circle"></i> {{ $po->delivered_at }}</div>
                    </td>
                    <td class="text-uppercase fw-bold @if ($po->status === 'pending') text-danger @elseif ($po->status === 'shipped') text-warning-emphasis @elseif ($po->status === 'completed') text-success @else text-secondary @endif">
                        {{ $po->status }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-5 text-center">{{ __('No users found.') }}</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection

