<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function getCategoryCardData(): View
    {
        $categories = Category::take(3)
            ->get()
            ->where('active', true);

        return view('CategoryCard', compact('categories'));
    }

    public function index(): View
    {
        $categories = Category::where('active', true)
            //->orderBy('name')
            ->get();
        return view('category.index', compact('categories'));
    }

    public function indexVendor(): View
    {

        $categories = Category::orderBy('name')->get();
        return view('vendor.category.index', compact('categories'));
    }

    public function create(): View
    {
        return view('category.create');
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        Category::create($request->all());
        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }


    public function show(Category $category): View
    {
        return view('category.show', compact('category'));
    }

    public function edit(Category $category): View
    {
        return view('category.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->all());
        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        //$category->delete();
        $category->update(['active' => false]);
        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }
}
