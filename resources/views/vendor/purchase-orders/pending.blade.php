@extends('layouts.admin-layout')

@section('title', 'Pending PO')

@section('headextra')
    @vite(['node_modules/jquery/dist/jquery.min.js'])
@endsection

@section('content')
    @component('components.navbar')
    @endcomponent

    <div class="container mt-4 main" style="min-height: 80vh">


        <h2 class="mt-3">{{ __('Pending Orders') }} ({{ $pendingOrders->count() }})</h2>

        <table class="table mt-3">
            <thead>
            <tr>
                <th class="fw-bold fs-5 ps-3">Identifier</th>
                <th class="fw-bold fs-5 ps-3">Owner</th>
                <th class="fw-bold fs-5 ps-3">Date</th>
                <th class="fw-bold fs-5 ps-3">Amount</th>
                <th class="fw-bold fs-5 ps-3">Status</th>


            </tr>
            </thead>
            <tbody>
            @forelse ($pendingOrders as $po)
                <tr>
                    <td class="ps-2">
                        <a href="{{ route('vendor.purchase-orders.showPending', $po->id) }}">
                            {{ $po->order_number }}
                        </a>
                    </td>
                    <td class="ps-4">{{ $po->user->name }}</td>
                    <td>{{ $po->created_at }}</td>
                    <td>${{ $po->total }}</td>
                    <td>
                        <div class="dropdown-center">
                            <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $po->status }}
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <form action="{{ route('purchaseOrders.ship', $po->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="dropdown-item">Ship</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
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

