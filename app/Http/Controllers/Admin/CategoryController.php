<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::simplepaginate(15);
        return view('admin.pages.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|unique:categories,name']);
        Category::create($request->only('name'));
        return redirect()->route('admin.category.index')->with('success', 'Category created.');
    }

    public function edit(Category $category)
    {
        return view('admin.pages.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate(['name' => 'required|string']);
        $category->update($request->only('name'));
        return redirect()->route('admin.category.index')->with('success', 'Category updated.');
    }

    public function delete(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.category.index')->with('success', 'Category deleted.');
    }
}
