<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function store(Request $request)
    {
        $product = Product::create($request->only('name', 'quantity', 'price'));
        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($request->action === 'restock') {
            $product->quantity += 10;
        } elseif ($request->action === 'buy') {
            $product->quantity = max(0, $product->quantity - 1);
        }

        $product->save();
        return response()->json($product);
    }
}
