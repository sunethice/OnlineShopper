<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::all(),200);
    }

    public function store(Request $request)
    {
    }

    public function show(Product $product)
    {
        return response()->json($product,200);
    }

    public function update(Request $request, Product $product)
    {
    }

    public function destroy(Product $product)
    {
    }
}
