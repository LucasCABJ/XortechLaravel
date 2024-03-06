@extends('layouts.admin-layout')

@section('title', 'Display PO')

@section('headextra')
    @vite(['node_modules/jquery/dist/jquery.min.js'])
@endsection

@section('content')
    @component('components.navbar')
    @endcomponent

    <div class="container pt-4 main bg-grey">

        <div class="container bg-white p-3" style="min-height: 60vh">
            <ul class="nav nav-tabs" id="tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active"
                            id="pending-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#tab-pending"
                            type="button"
                            role="tab"
                            aria-controls="tab-pending"
                            aria-selected="true">
                        Pending Orders <span class="badge text-bg-secondary">{{ $pendingOrders->count() }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link"
                            id="shipped-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#tab-shipped"
                            type="button"
                            role="tab"
                            aria-controls="tab-shipped"
                            aria-selected="false">
                        Shipped Orders <span class="badge text-bg-secondary">{{ $shippedOrders->count() }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link"
                            id="delivered-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#tab-delivered"
                            type="button"
                            role="tab"
                            aria-controls="tab-delivered"
                            aria-selected="false">
                        Delivered Orders <span class="badge text-bg-secondary">{{ $deliveredOrders->count() }}</span>
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="tabContent">
                <div class="tab-pane fade show active"
                     id="tab-pending"
                     role="tabpanel"
                     aria-labelledby="pending-tab"
                     tabindex="0">
                    {{-- PENDING ORDERS --}}
                    <table class="table border-start border-end">
                        <thead>
                        <tr>
                            <th class="fw-bold fs-5 ps-3">Identifier</th>
                            <th class="fw-bold fs-5 ps-3">Owner</th>
                            <th class="fw-bold fs-5 ps-3">Dates</th>
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
                                <td>
                                    <div><i class="text-danger fas fa-calendar-alt"></i> {{ $po->created_at }}</div>
                                    <div><i class="text-warning-emphasis fas fa-shipping-fast"></i> {{ $po->shipped_at }}</div>
                                    <div><i class="text-success fas fa-check-circle"></i> {{ $po->delivered_at }}</div>
                                </td>
                                <td>${{ $po->total }}</td>
                                <td>
                                    <div class="dropdown-center">
                                        <button class="btn btn-warning dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                            {{ $po->status }}
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <form action="{{ route('purchaseOrders.ship', $po->id) }}"
                                                      method="POST">
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
                                <td colspan="6" class="p-5 text-center">{{ __('No orders pending.') }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{-- END PENDING ORDERS --}}
                </div>
                <div class="tab-pane fade"
                     id="tab-shipped"
                     role="tabpanel"
                     aria-labelledby="shipped-tab"
                     tabindex="0">
                    {{-- SHIPPED ORDERS --}}
                    <table class="table border-start border-end">
                        <thead>
                        <tr>
                            <th class="fw-bold fs-5 ps-3">Identifier</th>
                            <th class="fw-bold fs-5 ps-3">Owner</th>
                            <th class="fw-bold fs-5 ps-3">Dates</th>
                            <th class="fw-bold fs-5 ps-3">Amount</th>
                            <th class="fw-bold fs-5 ps-3">Status</th>


                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($shippedOrders as $po)
                            <tr>
                                <td class="ps-2">
                                    <a href="{{ route('vendor.purchase-orders.showPending', $po->id) }}">
                                        {{ $po->order_number }}
                                    </a>
                                </td>
                                <td class="ps-4">{{ $po->user->name }}</td>
                                <td>
                                    <div><i class="text-danger fas fa-calendar-alt"></i> {{ $po->created_at }}</div>
                                    <div><i class="text-warning-emphasis fas fa-shipping-fast"></i> {{ $po->shipped_at }}</div>
                                    <div><i class="text-success fas fa-check-circle"></i> {{ $po->delivered_at }}</div>
                                </td>
                                <td>${{ $po->total }}</td>
                                <td>
                                    <div class="dropdown-center">
                                        <button class="btn btn-warning dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                            {{ $po->status }}
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <form action="{{ route('purchaseOrders.deliver', $po->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="dropdown-item">Deliver</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-5 text-center">{{ __('No orders shipped.') }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{-- END SHIPPED ORDERS --}}
                </div>
                <div class="tab-pane fade"
                     id="tab-delivered"
                     role="tabpanel"
                     aria-labelledby="delivered-tab"
                     tabindex="0">
                    {{-- DELIVERED ORDERS --}}
                    <table class="table border-start border-end">
                        <thead>
                        <tr>
                            <th class="fw-bold fs-5 ps-3">Identifier</th>
                            <th class="fw-bold fs-5 ps-3">Owner</th>
                            <th class="fw-bold fs-5 ps-3">Dates</th>
                            <th class="fw-bold fs-5 ps-3">Amount</th>
                            <th class="fw-bold fs-5 ps-3">Status</th>


                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($deliveredOrders as $po)
                            <tr>
                                <td class="ps-2">
                                    <a href="{{ route('vendor.purchase-orders.showPending', $po->id) }}">
                                        {{ $po->order_number }}
                                    </a>
                                </td>
                                <td class="ps-4">{{ $po->user->name }}</td>
                                <td>
                                    <div><i class="text-danger fas fa-calendar-alt"></i> {{ $po->created_at }}</div>
                                    <div><i class="text-warning-emphasis fas fa-shipping-fast"></i> {{ $po->shipped_at }}</div>
                                    <div><i class="text-success fas fa-check-circle"></i> {{ $po->delivered_at }}</div>
                                </td>
                                <td>${{ $po->total }}</td>
                                <td class="text-uppercase fw-bolder text-success">{{ $po->status }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-5 text-center">{{ __('No orders completed.') }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{-- END DELIVERED ORDERS --}}
                </div>
            </div>
        </div>
@endsection

