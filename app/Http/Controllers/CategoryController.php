<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Menambah kategori',
            'description' => "Menambahkan kategori baru '$request->name'"
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

        $oldName = $data->name;
        $oldDescription = $data->description;

        $data->update([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        $changes = [];

        if ($oldName !== $request->name) {
            $changes[] = "nama dari '$oldName' menjadi '{$request->name}'";
        }

        if ($oldDescription !== $request->description) {
            $changes[] = "deskripsi dari '$oldDescription' menjadi '{$request->description}'";
        }

        $description = count($changes) > 0
            ? 'Mengupdate kategori: ' . implode(' dan ', $changes)
            : 'Tidak ada perubahan';

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Mengupdate kategori',
            'description' => $description
        ]);

        return redirect()->route('category.index')->with('success', "$request->name berhasil diupdate");
    }

    public function destroy(string $id)
    {
        $data = Category::find($id);
        $data->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Menghapus kategori',
            'description' => "Menghapus kategori '$data->name'"
        ]);

        return redirect()->route('category.index')->with('success', "$data->name berhasil dihapus");
    }
}
