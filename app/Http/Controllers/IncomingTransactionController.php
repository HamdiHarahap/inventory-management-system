<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Models\TransactionItem;
use App\Models\IncomingTransaction;
use Illuminate\Support\Facades\Auth;

class IncomingTransactionController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('keyword');

        $data = TransactionItem::where('transaction_type', 'incoming')
            ->with(['incoming.supplier', 'product'])
            ->when($q, function ($query) use ($q) {

                $query->whereHas('incoming.supplier', function($q2) use ($q) {
                    $q2->where('name', 'like', "%$q%");
                })
                ->orWhereHas('product', function($q3) use ($q) {
                    $q3->where('name', 'like', "%$q%");
                })
                ->orWhereHas('outgoing', function($q4) use ($q) {
                    $q4->where('date', 'like', "%$q%");
                });
            })
            ->get();

        return view('transaction.incoming.index', [
            'title' => 'Transaksi Masuk',
            'data' => $data,
        ]);
    }

    public function create()
    {
        return view('transaction.incoming.create', [
            'title' => 'Transaksi Masuk',
            'data' => [
                'supplier' => Supplier::all(),
                'product' => Product::all()
            ]
        ]);
    }

    public function store(Request $request) 
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'product_id'  => 'required|exists:products,id',
            'qty'         => 'required|integer|min:1',
            'price'       => 'required|numeric|min:0',
            'total'       => 'required|numeric|min:0',
            'date'        => 'required|date',
            'notes'       => 'nullable|string',
        ]);

        $product = Product::find($request->product_id);

        $product->stock += (int)$request->qty;
        $product->save();

        $incoming = IncomingTransaction::create([
            'supplier_id' => $request->supplier_id,
            'date'        => $request->date,
            'notes'       => $request->notes,
        ]);

        TransactionItem::create([
            'transaction_type' => 'incoming',
            'transaction_id'   => $incoming->id,
            'product_id'       => $request->product_id,
            'qty'              => $request->qty,
            'subtotal'         => $request->total,
        ]);

        ActivityLog::create([
            'user_id'    => Auth::id(),
            'action'     => 'Menambah transaksi masuk',
            'description'=> "Produk '$product->name' sebanyak {$request->qty}",
        ]);

        return redirect()->route('incoming.index')->with('success', 'Transaksi masuk berhasil ditambahkan.');
    }


}
