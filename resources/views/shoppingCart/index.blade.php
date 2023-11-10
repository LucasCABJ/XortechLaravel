@extends('layouts.app')

@section('content')
    @component('components.navbar')
    @endcomponent

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Shopping Cart</h1>
                <hr>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{ $total = 0 }}
                    @foreach($shoppingCart as $item)
                        {{ $total += $item->subtotal() }}
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>
                                <div class="input-group">
                                    <form
                                        action="{{ route('shoppingCart.decreaseQuantity', $item->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-outline-th-tertiary" type="submit" id="decrement">
                                            <i class="fa-regular fa-minus"></i>
                                        </button>
                                    </form>
                                    <input type="text" class="text-center qty" disabled value="{{ $item->quantity }}"
                                           aria-label="Quantity" aria-describedby="button-addon1">
                                    <form
                                        action="{{ route('shoppingCart.increaseQuantity',$item->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-outline-th-tertiary" type="submit" id="increment">
                                            <i class="fa-regular fa-plus"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td>{{ $item->product->price }}</td>
                            <td>{{ $item->subtotal() }}</td>
                            <td>
                                {{--<a href="{{ route('shoppingCartItems.edit', $item->id) }}"
                                   class="btn btn-primary">Edit</a>
                                <form action="{{ route('shoppingCartItems.destroy', $item->id) }}" method="POST"
                                      style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="3"></td>
                        <td>{{ $total }}</td>
                        <td></td>
                    </tr>
                    </tfoot>
                </table>
                {{--                <a href="{{ route('shoppingCart.addProduct') }}" class="btn btn-primary">Add to Cart</a>--}}
                <a href="{{--{{ route('orders.create') }}--}}" class="btn btn-success">Checkout</a>
                <form action="{{ route('shoppingCart.emptyCart') }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Empty Cart" class="btn btn-danger
                </form>
            </div>
        </div>

@endsection
