<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::where('active', true)
            ->orderBy('name')
            ->get();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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


    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->all());
        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->update(['active' => false]);
        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    function home() {
        return view('product.home');
    }

}
