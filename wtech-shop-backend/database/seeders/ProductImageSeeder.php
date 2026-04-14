<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [
            'iPhone 15 Pro'      => '/assets/phones/phone-iphone.jpg',
            'Samsung Galaxy S24' => '/assets/phones/samsung.jpg',
            'Xiaomi 14'          => '/assets/phones/xiaomi.jpg',
            'Google Pixel 8'     => '/assets/phones/nexus.jpg',
            'OnePlus 12'         => '/assets/phones/honor.jpg',
            'MacBook Pro 14'     => '/assets/notebook.jpg',
            'Dell XPS 15'        => '/assets/notebook.jpg',
            'Lenovo ThinkPad X1' => '/assets/notebook.jpg',
            'ASUS ROG Zephyrus'  => '/assets/notebook.jpg',
            'HP Spectre x360'    => '/assets/notebook.jpg',
        ];

        Product::all()->each(function ($product) use ($images) {
            ProductImage::create([
                'product_id' => $product->id,
                'url'        => $images[$product->name] ?? '/assets/phones/honor.jpg',
                'sort_order' => 0,
            ]);
        });
    }
}
