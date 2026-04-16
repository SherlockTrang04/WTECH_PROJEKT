<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('images')->get();
        return view('product_list', compact('products'));
    }

    public function show($id)
    {
        $product = Product::with('images')->findOrFail($id);
        return view('product', compact('product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'images' => 'required|array|min:3',
            'images.*' => 'required|url',
        ]);

        $product = Product::create($request->only(['name', 'description', 'price', 'category_id', 'brand', 'color', 'stock']));

        foreach ($request->images as $index => $url) {
            ProductImage::create([
                'product_id' => $product->id,
                'url' => $url,
                'sort_order' => $index,
            ]);
        }

        return response()->json(['success' => true, 'product' => $product]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'images' => 'required|array|min:3',
            'images.*' => 'required|url',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->only(['name', 'description', 'price', 'category_id', 'brand', 'color', 'stock']));


        $product->images()->delete();

        // Add new images
        foreach ($request->images as $index => $url) {
            ProductImage::create([
                'product_id' => $product->id,
                'url' => $url,
                'sort_order' => $index,
            ]);
        }

        return response()->json(['success' => true, 'product' => $product]);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['success' => true]);
    }
}