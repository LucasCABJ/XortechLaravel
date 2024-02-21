<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\PurchaseOrder;
class PurchaseOrderController extends Controller
{
    /**
     * Checkout the shopping cart
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    /*public function checkout(): RedirectResponse
    {
        $user = Auth::user(); // Obtener el usuario autenticado
        $shoppingCart = ShoppingCart::where('user_id', $user->id)
            ->get(); // Obtener los productos en el carrito
        $total = 0;
        foreach ($shoppingCart as $item) {
            $total += $item->subtotal();
        } // Calcular el total de la compra

        $purchaseOrder = PurchaseOrder::create([
            'order_number' => 'PO-' . time(),
            'user_id' => $user->id,
            'total' => $total,
            'status' => 'pending',
        ]); // Crear la orden de compra
        foreach ($shoppingCart as $item) {
            Sale::create([
                'product_id' => $item->product_id,
                'purchase_order_id' => $purchaseOrder->id,
                'sale_price' => $item->product->price,
                'quantity' => $item->quantity,
            ]); // Crear la venta de cada producto

            $item->delete(); // Eliminar el producto del carrito
        }
        return redirect()->route('purchaseOrder.show', $purchaseOrder);
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        // Verificar si el usuario tiene acceso a la orden de compra
        if ($purchaseOrder->user_id !== auth()->id()) {
            return abort(403); // Acceso no autorizado
        }

        // Cargar los detalles de la orden de compra y sus ventas asociadas
        $purchaseOrder->load('sales.product');

        // Retornar la vista de detalles de la orden de compra
        return view('purchase-orders.show', compact('purchaseOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function pendingOrders(): View
    {
        // Obtener todas las órdenes pendientes
        $pendingOrders = PurchaseOrder::where('status', 'pending')->get();

        // Retornar la vista de órdenes pendientes
        return view('purchase_orders.pending', compact('pendingOrders'));
    }

    /**
     * Approve a purchase order
     *
     * @param PurchaseOrder $purchaseOrder
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approveOrder(PurchaseOrder $purchaseOrder): RedirectResponse
    {
        // Verificar si el usuario autenticado tiene permisos de administrador o vendedor
        if (!auth()->user()->isAdminOrVendor()) {
            return abort(403); // Acceso no autorizado
        }

        // Cambiar el estado de la orden de "pendiente" a "aprobada"
        $purchaseOrder->update(['status' => 'approved']);

        // Redirigir de vuelta a la página de órdenes pendientes
        return redirect()->route('purchaseOrder.pendingOrders')->with('success', 'Order approved successfully');
    }


}
