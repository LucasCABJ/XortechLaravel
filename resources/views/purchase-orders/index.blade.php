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

        <table class="table mt-3">
            <thead>
            <tr>
                <th class="fw-bold fs-5 ps-3">Identifier</th>
                <th class="fw-bold fs-5 ps-3">Date</th>
                <th class="fw-bold fs-5 ps-3">Amount</th>
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
                    <td>{{ $po->created_at }}</td>
                    <td>${{ $po->total }}</td>
                    <td>{{ $po->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-5 text-center">{{ __('No users found.') }}</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection

