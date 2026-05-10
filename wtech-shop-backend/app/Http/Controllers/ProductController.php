<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('images')->where('is_active', true);

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                  ->orWhere('description', 'like', "%{$term}%");
            });
        }

        if ($request->filled('price_min') && (float) $request->price_min > 0) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->filled('price_max') && (float) $request->price_max < 2000) {
            $query->where('price', '<=', $request->price_max);
        }

        if ($request->filled('brand')) {
            $query->whereIn('brand', explode(',', $request->brand));
        }

        if ($request->filled('stars') && $request->stars > 0) {
            $query->where('stars', '>=', $request->stars);
        }

        match ($request->sort) {
            'price_asc'  => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            default      => $query->latest(),
        };

        $products   = $query->paginate(6)->withQueryString();
        $categories = Category::all();
        $brands     = Product::where('is_active', true)
                             ->whereNotNull('brand')
                             ->where('brand', '!=', '')
                             ->selectRaw('brand, count(*) as count')
                             ->groupBy('brand')
                             ->orderBy('brand')
                             ->get();

        return view('product_list', compact('products', 'categories', 'brands'));
    }

    public function show(Product $product)
    {
        $product->load('images');
        $categories = Category::all();
        $similar    = Product::with('images')
                             ->where('category_id', $product->category_id)
                             ->where('id', '!=', $product->id)
                             ->where('is_active', true)
                             ->inRandomOrder()
                             ->limit(4)
                             ->get();

        return view('product', compact('product', 'categories', 'similar'));
    }
}
