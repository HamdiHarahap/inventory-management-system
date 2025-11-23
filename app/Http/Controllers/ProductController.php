<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('product.index', [
            'title' => 'Produk'
        ]);
    }

    public function create()
    {
        return view('product.add', [
            "title" => 'Produk'
        ]);
    }
}
