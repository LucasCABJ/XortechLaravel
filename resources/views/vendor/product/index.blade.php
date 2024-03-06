@extends('layouts.admin-layout')

@section('content')
    @component('components.navbar')
    @endcomponent

    <div class="container my-5 ms-2">
        <a href="{{ route('vendor.product.create') }}" class="btn btn-th-primary text-light mb-3"><i class="fas fa-plus"></i> Create Product</a>

        <h2 class="ms-2">Active Products: {{ $total->where('active', 1)->count() }}</h2>
        <h2 class="ms-2">Paused Products: {{ $total->where('active', 0)->count() }}</h2>

        @if(count($products) > 0)
            <div class="container p-4">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>
                                <a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a>
                            </td>
                            <td>
                                @if($product->active == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Paused</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('vendor.product.edit', $product->id) }}" class="btn btn-warning me-2"><i class="fas fa-edit"></i> Edit</a>
                                @if($product->active == 1)
                                    <form action="{{ route('vendor.product.destroy', $product->id) }}" method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger"><i class="fas fa-pause"></i> Pause</button>
                                    </form>
                                @else
                                    <form action="{{ route('vendor.product.reactivate', $product->id) }}" method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-outline-th-info"><i class="fas fa-play"></i> Activate</button>
                                    </form>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        @else
            <p>No products found</p>
        @endif
        {{ $products->links() }}
    </div>
@endsection
