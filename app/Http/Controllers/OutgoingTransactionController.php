<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ActivityLog;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\TransactionItem;
use App\Models\OutgoingTransaction;
use Illuminate\Support\Facades\Auth;

class OutgoingTransactionController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('keyword');

        $data = TransactionItem::where('transaction_type', 'outgoing')
            ->with(['outgoing.customer', 'product'])
            ->when($q, function ($query) use ($q) {

                $query->whereHas('outgoing.customer', function($q2) use ($q) {
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

        return view('transaction.outgoing.index', [
            'title' => 'Transaksi Keluar',
            'data' => $data,
        ]);
    }

    public function create()
    {
        return view('transaction.outgoing.create', [
            'title' => 'Transaksi Keluar',
            'data' => [
                'customer' => Customer::all(),
                'product' => Product::all()
            ]
        ]);
    }

    public function store(Request $request) 
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id'  => 'required|exists:products,id',
            'qty'         => 'required|integer|min:1',
            'price'       => 'required|numeric|min:0',
            'total'       => 'required|numeric|min:0',
            'date'        => 'required|date',
            'notes'       => 'nullable|string',
        ]);

        $product = Product::find($request->product_id);

        $product->stock -= (int)$request->qty;
        $product->save();

        $outgoing = OutgoingTransaction::create([
            'customer_id' => $request->customer_id,
            'date'        => $request->date,
            'notes'       => $request->notes,
        ]);

        TransactionItem::create([
            'transaction_type' => 'outgoing',
            'transaction_id'   => $outgoing->id,
            'product_id'       => $request->product_id,
            'qty'              => $request->qty,
            'subtotal'         => $request->total,
        ]);

        ActivityLog::create([
            'user_id'    => Auth::id(),
            'action'     => 'Menambah transaksi Keluar',
            'description'=> "Produk '$product->name' sebanyak {$request->qty}",
        ]);

        return redirect()->route('outgoing.index')->with('success', 'Transaksi keluar berhasil ditambahkan.');
    }
}
