<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\QueryException;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::orderBy('name')
            ->get();
        return view('product.index', compact('products'));
    }

    public function create(): View
    {
        $categories = Category::where('active', true)
            ->orderBy('name')
            ->get();
        return view('product.create', compact('categories'));
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        Product::create($request->all());
        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product): View
    {
        return view('product.show', compact('product'));
    }

    public function edit(Product $product): View
    {
        $categories = Category::where('active', true)
            ->orderBy('name')
            ->get();
        return view('product.edit', compact('product', 'categories'));
    }


    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $request->only(['name', 'short_desc', 'long_desc', 'price', 'category_id']);
        $data['active'] = $request->has('active');

        // Actualiza los datos del producto
        $product->update($data);

        // Verifica si se seleccionaron imágenes para eliminar
        if ($request->has('delete_image')) {
            // Obtiene las IDs de las imágenes seleccionadas
            $selectedImageIds = $request->input('delete_image');

            // Elimina las imágenes seleccionadas
            $product->images()->whereIn('id', $selectedImageIds)->delete();
        }

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }


    public function destroy(Product $product): RedirectResponse
    {
        $product->update(['active' => false]);
        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }

    function home()
    {
        return view('product.home');
    }

}
