<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\PurchaseOrder;
class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * USER SIDE
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        // Obtener todas las órdenes de compra del usuario autenticado
        $purchaseOrders = PurchaseOrder::where('user_id', auth()->id())->get();

        // Retornar la vista de órdenes de compra
        return view('purchase-orders.index', compact('purchaseOrders'));
    }

    /**
     * Display the specified resource. USER SIDE
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseOrder $purchaseOrder): View
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
     * Display the specified resource. ADMIN SIDE
     *
     * @param  \App\Models\PurchaseOrder  $pendingOrder
     * @return \Illuminate\Http\Response
     */
    public function showPending(PurchaseOrder $pendingOrder): View
    {
        // Verificar si el usuario tiene acceso a la orden de compra
        /*if ($purchaseOrder->user_id !== auth()->id()) {
            return abort(403); // Acceso no autorizado
        }*/

        // Cargar los detalles de la orden de compra y sus ventas asociadas
        $pendingOrder->load('sales.product');

        // Retornar la vista de detalles de la orden de compra
        return view('vendor.purchase-orders.showPending', compact('pendingOrder'));
    }

    /**
     * Display a listing of the resource. ADMIN SIDE
     *
     * @return \Illuminate\View\View
     */
    public function list(): View
    {
        // Obtener todas las órdenes pendientes
        $pendingOrders = PurchaseOrder::where('status', 'pending')->get();
        $shippedOrders = PurchaseOrder::where('status', 'shipped')->get();
        $deliveredOrders = PurchaseOrder::where('status', 'completed')->get();

        // Retornar la vista de órdenes pendientes
        return view('vendor.purchase-orders.list', compact('pendingOrders', 'shippedOrders', 'deliveredOrders'));
    }

    /**
     * Ship the specified purchase order.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ship(PurchaseOrder $purchaseOrder): RedirectResponse
    {
        // Actualizar el estado de la orden a "Shipped"
        $purchaseOrder->update(['status' => 'shipped']);
        $purchaseOrder->update(['shipped_at' => now()]);

        // Redirigir de vuelta a la página de órdenes
        return redirect()->route('vendor.purchase-orders.list')->with('success', 'Order shipped successfully');
    }

    /**
     * Delivery the specified purchase order.
     * @param \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deliver(PurchaseOrder $purchaseOrder): RedirectResponse
    {
        // Actualizar el estado de la orden a "Delivered"
        $purchaseOrder->update(['status' => 'completed']);
        $purchaseOrder->update(['delivered_at' => now()]);

        // Redirigir de vuelta a la página de órdenes
        return redirect()->route('vendor.purchase-orders.list')->with('success', 'Order delivered successfully');

    }
}
