<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ActivityLog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->keyword;

        $data = Product::when($q, function ($query) use ($q) {
            $query->where('name', 'like', "%$q%")
                ->orWhere('unit', 'like', "%$q%");
        })->get();

        return view('product.index', [
            'title' => 'Produk',
            'data' => $data,
        ]);
    }

    public function create()
    {
        $sku = 'PRD-' . strtoupper(Str::random(6));

        $barcode = '';
        for ($i = 0; $i < 13; $i++) {
            $barcode .= rand(0, 9);
        }

        return view('product.create', [
            'title' => 'Produk',
            'category' => Category::all(),
            'sku' => $sku,
            'barcode' => $barcode,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required',
            'price_sell'  => 'required|numeric|min:0',
            'price_buy'   => 'required|numeric|min:0',
            'unit'       => 'required|string|max:50',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name'        => $request->name,
            'sku'         => $request->sku,
            'barcode'     => $request->barcode,
            'price_sell'  => $request->price_sell,
            'price_buy'   => $request->price_buy,
            'unit'       => $request->unit,
            'stock'       => $request->stock,
            'image'       => $imagePath,
            'category_id' => $request->category,
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Menambah produk',
            'description' => "Menambahkan produk baru '$request->name'"
        ]);

        return redirect()->route('product.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        return view('product.edit', [
            'title' => 'Produk',
            'category' => Category::all(),
            'data' => Product::find($id)
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required',
            'price_sell'  => 'required|numeric|min:0',
            'price_buy'   => 'required|numeric|min:0',
            'unit'        => 'required|string|max:50',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $product = Product::findOrFail($id);

        $oldData = $product->only(['name','price_sell','price_buy','unit','stock','category_id','image']);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            if ($product->image && file_exists(storage_path('app/public/' . $product->image))) {
                unlink(storage_path('app/public/' . $product->image));
            }
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name'        => $request->name,
            'price_sell'  => $request->price_sell,
            'price_buy'   => $request->price_buy,
            'unit'        => $request->unit,
            'stock'       => $request->stock,
            'category_id' => $request->category,
            'image'       => $imagePath,
        ]);

        $changes = [];

        if ($oldData['name'] !== $request->name) {
            $changes[] = "nama dari '{$oldData['name']}' menjadi '{$request->name}'";
        }
        if ($oldData['price_sell'] != $request->price_sell) {
            $changes[] = "harga jual dari '{$oldData['price_sell']}' menjadi '{$request->price_sell}'";
        }
        if ($oldData['price_buy'] != $request->price_buy) {
            $changes[] = "harga beli dari '{$oldData['price_buy']}' menjadi '{$request->price_buy}'";
        }
        if ($oldData['unit'] !== $request->unit) {
            $changes[] = "unit dari '{$oldData['unit']}' menjadi '{$request->unit}'";
        }
        if ($oldData['stock'] != $request->stock) {
            $changes[] = "stok dari '{$oldData['stock']}' menjadi '{$request->stock}'";
        }
        if ($oldData['category_id'] != $request->category) {
            $oldCategory = Category::find($oldData['category_id'])->name ?? '-';
            $newCategory = Category::find($request->category)->name ?? '-';
            $changes[] = "kategori dari '{$oldCategory}' menjadi '{$newCategory}'";
        }
        if ($oldData['image'] !== $imagePath) {
            $changes[] = "gambar produk diubah";
        }

        $description = count($changes) > 0
            ? 'Mengupdate produk: ' . implode(' dan ', $changes)
            : 'Tidak ada perubahan';

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Mengupdate produk',
            'description' => $description
        ]);

        return redirect()->route('product.index')->with('success', "$product->name berhasil diperbarui!");
    }

    public function destroy(string $id)
    {
        $data = Product::find($id);
        $data->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Menghapus produk',
            'description' => "Menghapus produk '$data->name'"
        ]);

        return redirect()->route('product.index')->with('success', "$data->name berhasil dihapus");
    }

}
