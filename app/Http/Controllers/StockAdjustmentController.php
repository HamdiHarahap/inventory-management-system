<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Models\StockAdjustment;
use Illuminate\Support\Facades\Auth;

class StockAdjustmentController extends Controller
{
    public function index()
    {
        return view('product.stock-adjust', [
            'title' => 'Ubah Stok',
            'product' => Product::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id'  => 'required|exists:products,id',
            'adjustment_type' => 'required',
            'qty' => 'required|integer|min:1',
            'reason' => 'required|string',
        ]);

        StockAdjustment::create([
            'product_id' => $request->product_id,
            'adjustment_type' => $request->adjustment_type,
            'qty' => $request->qty,
            'reason' => $request->reason
        ]);

        $product = Product::find($request->product_id);

        $request->adjustment_type == 'add' ? $product->stock += (int)$request->qty : $product->stock -= (int)$request->qty;
        
        $product->save();

        $actionText = $request->adjustment_type == 'add' ? 'Menambah stok' : 'Mengurangi stok';

        ActivityLog::create([
            'user_id'    => Auth::id(),
            'action'     => $actionText,
            'description'=> "$actionText pada produk '{$product->name}' sebanyak {$request->qty}. Alasan: {$request->reason}",
        ]);

        return back()->with('success', 'Penyesuaian stok berhasil disimpan!');
    }
}
