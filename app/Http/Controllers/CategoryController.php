<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('active',true)
            ->orderBy('name')
            ->get();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'description' => 'nullable|max:255'
        ]);

        Category::create($request->all());
        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }


    public function show(Category $category)
    {
        return view('category.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:100',
            'description' => 'nullable|max:255'
        ]);

        $category->update($request->all());
        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        //$category->delete();
        $category->update(['active' => false]);
        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }
}
