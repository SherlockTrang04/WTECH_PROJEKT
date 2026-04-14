<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_active', true)->with('images');

        //filtrovanie podla kategorii
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        //filtrovanie podla ceny
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        //filtrovanie podla znacky
        if ($request->filled('brand')) {
            $brands = explode(',', $request->brand);
            $query->whereIn('brand', $brands);
        }

        //filtrovanie podla star
        if ($request->filled('stars')) {
            $query->where('stars', '>=', (int)$request->stars);
        }

        //search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereRaw("search_vector @@ plainto_tsquery('english', ?)", [$search]);
        }

        $sort = $request->get('sort', 'newest');
        match ($sort) {
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'stars_desc' => $query->orderBy('stars', 'desc'),
            default => $query->orderBy('created_at', 'desc'),
        };

        $products = $query->paginate(9)->withQueryString();
        $categories = \App\Models\Category::all();

        return view('product_list', compact('products', 'categories'));
    }

    public function show(Product $product) {
        $product->load('images', 'category');
        $similar = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->limit(3)->get();

        return view('product', compact('product', 'similar'));
    }
}
