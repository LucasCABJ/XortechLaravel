<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\ShoppingCart;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;

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
        $user = Auth::user();
        $shoppingCart = ShoppingCart::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();
        if ($shoppingCart) {
            $shoppingCart->quantity += 1;
            $shoppingCart->save();
        } else {
            ShoppingCart::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }
        return redirect()->route('shoppingCart.index');
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

}
