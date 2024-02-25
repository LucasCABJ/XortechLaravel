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
     * Display the specified resource.
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
    public function pending(): View
    {
        // Obtener todas las órdenes pendientes
        $pendingOrders = PurchaseOrder::where('status', 'pending')->get();

        // Retornar la vista de órdenes pendientes
        return view('vendor.purchase-orders.pending', compact('pendingOrders'));
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
        $purchaseOrder->update(['status' => 'Shipped']);
        $purchaseOrder->update(['shipped_at' => now()]);

        // Redirigir de vuelta a la página de órdenes pendientes
        return redirect()->route('vendor.purchase-orders.pending')->with('success', 'Order shipped successfully');
    }
}
