<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index()
    {
        $products   = Product::with('images', 'category')->latest()->get();
        $categories = Category::all();
        return view('admin', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'brand'       => 'nullable|string|max:255',
            'color'       => 'nullable|string|max:255',
            'stock'       => 'nullable|integer|min:0',
            'img1'        => 'nullable|image|max:4096',
            'img2'        => 'nullable|image|max:4096',
            'is_active'   => 'nullable',
        ]);

        $product = Product::create([
            'name'        => $data['name'],
            'price'       => $data['price'],
            'description' => $data['description'],
            'category_id' => $data['category_id'],
            'brand'       => $data['brand'] ?? null,
            'color'       => $data['color'] ?? null,
            'stock'       => $data['stock'] ?? 0,
            'is_active'   => isset($data['is_active']),
        ]);

        foreach (['img1' => 0, 'img2' => 1] as $field => $order) {
            if ($request->hasFile($field)) {
                $path = $request->file($field)->store('products', 'public');
                $product->images()->create([
                    'url'        => '/storage/' . $path,
                    'sort_order' => $order,
                ]);
            }
        }

        return back()->with('success', 'Produkt bol pridaný.');
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'price'         => 'required|numeric|min:0',
            'description'   => 'required|string',
            'category_id'   => 'required|exists:categories,id',
            'brand'         => 'nullable|string|max:255',
            'color'         => 'nullable|string|max:255',
            'stock'         => 'nullable|integer|min:0',
            'img1'          => 'nullable|image|max:4096',
            'img2'          => 'nullable|image|max:4096',
            'existing_img1' => 'nullable|string',
            'existing_img2' => 'nullable|string',
            'is_active'     => 'nullable',
        ]);

        $product->update([
            'name'        => $data['name'],
            'price'       => $data['price'],
            'description' => $data['description'],
            'category_id' => $data['category_id'],
            'brand'       => $data['brand'] ?? null,
            'color'       => $data['color'] ?? null,
            'stock'       => $data['stock'] ?? 0,
            'is_active'   => isset($data['is_active']),
        ]);

        // Delete stored files that are being replaced
        foreach ($product->images as $image) {
            $storagePath = Str::after($image->url, '/storage/');
            if ($storagePath && Storage::disk('public')->exists($storagePath)) {
                Storage::disk('public')->delete($storagePath);
            }
        }
        $product->images()->delete();

        foreach (['img1' => 0, 'img2' => 1] as $field => $order) {
            if ($request->hasFile($field)) {
                $path = $request->file($field)->store('products', 'public');
                $product->images()->create([
                    'url'        => '/storage/' . $path,
                    'sort_order' => $order,
                ]);
            } elseif (!empty($data["existing_{$field}"])) {
                $product->images()->create([
                    'url'        => $data["existing_{$field}"],
                    'sort_order' => $order,
                ]);
            }
        }

        return back()->with('success', 'Produkt bol upravený.');
    }

    public function destroy(Product $product)
    {
        foreach ($product->images as $image) {
            $storagePath = Str::after($image->url, '/storage/');
            if ($storagePath && Storage::disk('public')->exists($storagePath)) {
                Storage::disk('public')->delete($storagePath);
            }
        }
        $product->images()->delete();
        $product->delete();
        return back()->with('success', 'Produkt bol odstránený.');
    }
}
