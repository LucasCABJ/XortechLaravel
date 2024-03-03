<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\ShoppingCart;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use App\Models\PurchaseOrder;
use App\Models\Sale;

class ShoppingCartController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $shoppingCart = ShoppingCart::where('user_id', $user->id)
            ->get();
        return view('shoppingCart.index', compact('shoppingCart'));
    }

    public function addProduct(Request $request): RedirectResponse
    {
        $product = Product::find($request->product_id);

        // Verificar si el usuario está autenticado
        if (Auth::check()) {
            $user = Auth::user();
            $quantity = $request->quantity ? $request->quantity : 1;
            $shoppingCart = ShoppingCart::where('user_id', $user->id)
                ->where('product_id', $product->id)
                ->first();
            if ($shoppingCart) {
                $shoppingCart->quantity += $quantity;
                $shoppingCart->save();
            } else {
                ShoppingCart::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                ]);
            }
            return redirect()->route('shoppingCart.index');
        } else {
            // Manejar el caso en el que el usuario no está autenticado
            return redirect()->route('login')->with('error', 'You must be logged in to add products to the cart.');
        }
    }


    public function increaseQuantity(ShoppingCart $shoppingCart): RedirectResponse
    {
        $shoppingCart->quantity += 1;
        $shoppingCart->save();
        return redirect()->route('shoppingCart.index');
    }

    public function decreaseQuantity(ShoppingCart $shoppingCart): RedirectResponse
    {
        if ($shoppingCart->quantity > 1) {
            $shoppingCart->quantity -= 1;
            $shoppingCart->save();
        } else {
            $this->deleteProduct($shoppingCart);
        }
        return redirect()->route('shoppingCart.index');
    }

    public function deleteProduct(ShoppingCart $shoppingCart): RedirectResponse
    {
        $shoppingCart->delete();
        return redirect()->route('shoppingCart.index');
    }

    public function emptyCart(): RedirectResponse
    {
        $user = Auth::user();
        $shoppingCart = ShoppingCart::where('user_id', $user->id)
            ->get();
        foreach ($shoppingCart as $item) {
            $this->deleteProduct($item);
        }
        return redirect()->route('shoppingCart.index');
    }

    public function checkout(): RedirectResponse
    {
        $user = Auth::user();
        $shoppingCart = ShoppingCart::where('user_id', $user->id)->get();
        $total = 0;

        foreach ($shoppingCart as $item) {
            $total += $item->subtotal();
        }

        $purchaseOrder = PurchaseOrder::create([
            'order_number' => 'PO-' . time(),
            'user_id' => $user->id,
            'total' => $total,
            'status' => 'pending',
        ]);

        foreach ($shoppingCart as $item) {
            Sale::create([
                'product_id' => $item->product_id,
                'purchase_order_id' => $purchaseOrder->id,
                'sale_price' => $item->product->price,
                'quantity' => $item->quantity,
            ]);

            $item->delete();
        }

        return redirect()->route('purchase-orders.show', $purchaseOrder);
    }

}
