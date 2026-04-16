<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
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
=======
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
>>>>>>> efa068c0ce0df8696bb8b69393a6fc818b3d515c
