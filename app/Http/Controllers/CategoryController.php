<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('keyword');

        $data = Category::when($q, function ($query) use ($q) {
            $query->where('name', 'like', "%$q%")
                ->orWhere('description', 'like', "%$q%");
        })->get();

        return view('category.index', [
            'title' => 'Kategori',
            'data' => $data,
            'keyword' => $q
        ]);
    }


    public function create()
    {
        return view('category.create', [
            'title' => 'Kategori'
        ]);
    }

    public function store(Request $request) 
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        Category::create([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        return redirect()->route('category.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        return view('category.edit', [
            'title' => 'Kategori',
            'data' => Category::find($id)
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $data = Category::find($id);
        $data->update([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        $name = $request->input('name');

        return redirect()->route('category.index')->with('success', "$name berhasil diupdate");
    }

    public function destroy(string $id)
    {
        $data = Category::find($id);
        $data->delete();

        return redirect()->route('category.index')->with('success', "$data->name berhasil dihapus");
    }
}
