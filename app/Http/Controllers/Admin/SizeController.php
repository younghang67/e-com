<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::simplepaginate(15);
        return view('admin.pages.sizes.index', compact('sizes'));
    }

    public function create()
    {
        return view('admin.sizes.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|unique:sizes,name']);
        Size::create($request->only('name'));
        return redirect()->route('admin.size.index')->with('success', 'Size created.');
    }

    public function edit(Size $size)
    {
        return view('admin.pages.sizes.edit', compact('size'));
    }

    public function update(Request $request, Size $size)
    {
        $request->validate(['name' => 'required|string']);
        $size->update($request->only('name'));
        return redirect()->route('admin.size.index')->with('success', 'Size updated.');
    }

    public function delete(Size $size)
    {
        $size->delete();
        return redirect()->route('admin.size.index')->with('success', 'Size deleted.');
    }
}
