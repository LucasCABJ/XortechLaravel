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
        $images = $product->images()->orderBy('position')->get();
        $categories = Category::where('active', true)
            ->orderBy('name')
            ->get();
        return view('product.edit', compact('product', 'categories', 'images'));
    }


    /*public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $request->only(['name', 'short_desc', 'long_desc', 'price', 'category_id']);
        $data['active'] = $request->has('active');

        // Actualiza los datos del producto
        $product->update($data);

        if ($request->hasFile('image')) {
            //usar storeImage aqui
        }

        // Verifica si se seleccionaron imágenes para eliminar
        if ($request->has('delete_image')) {
            // Obtiene las IDs de las imágenes seleccionadas
            $selectedImageIds = $request->input('delete_image');

            // Elimina las imágenes seleccionadas
            $product->images()->whereIn('id', $selectedImageIds)->delete();
        }

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }*/

    private function processAndStoreImages(Request $request, Product $product)
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

    /*public function imageReorder(Request $request): JsonResponse
    {
        // Inicializa el índice en 1
        $index = 1;

        // Obtiene el array de datos desde la solicitud
        $data = $request['data'];

        // Verifica si hay elementos en el array
        if (count($data)) {
            // Recorre el array de datos
            for ($i = 0; $i < count($data); $i++) {
                // Encuentra el modelo Image por su ID
                $image = Image::find($data[$i]);

                // Si el índice es menor o igual a la cantidad de elementos en el array
                if ($index <= count($data)) {
                    // Actualiza la posición del modelo Image con el índice actual
                    $image->position = $index;
                    $image->save(); // Guarda los cambios en la base de datos
                }

                // Incrementa el índice
                $index++;
            }
        }

        // Devuelve una respuesta JSON con la URL de redirección
        return response()->json([
            'redirect' => url('product/edit')
        ]);
    }*/


    /*public function storeImages(Request $request, Product $product): RedirectResponse
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

        // Devuelve una respuesta de redirección
        return redirect()->route('product.edit', $product->id)->with('success', 'Images uploaded successfully.');
    }*/




}
