<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Category::where('active', true)
            ->orderBy('name')
            ->get();

        $products = Product::where('active', true)
            ->when($request->filled('search'), function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->input('search') . '%');
            })
            ->orderBy('name')
            ->paginate(5);

        //get first image from each product
        foreach ($products as $product) {
            $product->image = $product->images()->first();
        }

        return view('product.index', compact('products', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::where('active', true)
            ->orderBy('name')
            ->get();
        return view('vendor.product.create', compact('categories'));
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        Product::create($request->all());
        return redirect()->route('vendor.product.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product): View
    {
        return view('product.show', compact('product'));
    }

    public function edit(Product $product): View
    {
        $images = $product->images()->orderBy('position')->get();
        $categories = Category::where('active', true)
            ->orderBy('name')
            ->get();
        return view('vendor.product.edit', compact('product', 'categories', 'images'))->with('success', 'Product updated successfully.');
    }

    private function processAndStoreImages(Request $request, Product $product): void
    {
        $category = Category::where('id', $product->category_id)->first()->name;

        // Verifica si se han subido imágenes
        if ($request->hasFile('images')) {
            // Obtiene las imágenes subidas
            $images = $request->file('images');

            // Recorre las imágenes
            foreach ($images as $image) {
                // Guarda la imagen en una carpeta con el ID del producto y con el nombre hash del archivo
                $path = $image->storeAs("product/images/{$category}/{$product->id}", $image->hashName(), 'public');

                // Crea un nuevo modelo Image
                $newImage = new Image();

                // Establece la posición de la imagen
                $newImage->position = $product->images()->count() + 1;

                // Establece la ruta de almacenamiento de la imagen en la base de datos
                $newImage->url = $path;

                // Guarda la imagen en la base de datos
                $product->images()->save($newImage);
            }
        }
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

        // Llama al método para procesar y almacenar imágenes
        $this->processAndStoreImages($request, $product);

        return redirect()->route('vendor.product.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->update(['active' => false]);
        return redirect()->route('vendor.product.index')->with('success', 'Product deleted successfully.');
    }

    public function reactivate(Product $product): RedirectResponse
    {
        $product->update(['active' => true]);
        return redirect()->route('vendor.product.index')->with('success', 'Product reactivated successfully.');
    }


    public function home()
    {
        // Get a random product to show in the home page Hero
        $heroProduct = Product::where('active', true)
            ->inRandomOrder()
            ->first();

        //Get a random product to show in the home page Banner
        $bannerProduct = Product::where('active', true)
            ->inRandomOrder()
            ->first();

        // If user is logged in and user role is admin or vendor
        if (auth()->check() && (auth()->user()->hasrole('admin') || auth()->user()->hasrole('vendor'))) {
            return redirect()->route('vendor.purchase-orders.list');
        }
        return view('product.home', compact('heroProduct', 'bannerProduct'));
    }

    public function vendor(Request $request): View
    {
        $products = Product::orderBy('name')
            ->when($request->filled('search'), function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->input('search') . '%');
            })
            ->paginate(5);
        return view('vendor.product.index', compact('products'));
    }

    /**
     * Elige un producto aleatorio para mostrar en la página de inicio
     * @return View
     */
    public function heroProduct(): View
    {
        $heroProduct = Product::where('active', true)
            ->inRandomOrder()
            ->first();
        return view('hero', compact('heroProduct'));
    }

}
