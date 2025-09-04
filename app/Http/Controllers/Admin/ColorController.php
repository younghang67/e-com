<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::simplepaginate(15);
        return view('admin.pages.colors.index', compact('colors'));
    }

    public function create()
    {
        return view('admin.colors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'unique:colors,name'],
            'hex_value' => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
        ]);

        Color::create($validated);

        return redirect()->route('admin.color.index')->with('success', 'Color created.');
    }


    public function edit(Color $color)
    {
        return view('admin.pages.colors.edit', compact('color'));
    }

    public function update(Request $request, Color $color)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'hex_value' => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
        ]);
        $color->update($validated);
        return redirect()->route('admin.color.index')->with('success', 'Color updated.');
    }

    public function delete(Color $color)
    {
        $color->delete();
        return redirect()->route('admin.color.index')->with('success', 'Color deleted.');
    }
}
