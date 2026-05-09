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
            // Smartfóny
            'iPhone 15 Pro'           => '/assets/phones/phone-iphone.jpg',
            'Samsung Galaxy S24'      => '/assets/phones/samsung.jpg',
            'Xiaomi 14'               => '/assets/phones/xiaomi.jpg',
            'Google Pixel 8'          => '/assets/phones/nexus.jpg',
            'OnePlus 12'              => '/assets/phones/honor.jpg',
            'Huawei P60 Pro'          => '/assets/phones/huawei.jpg',
            'Motorola Edge 40'        => '/assets/phones/motorola.jpg',
            'Sony Xperia 5 V'         => '/assets/phones/sony.jpg',
            'OPPO Find X7'            => '/assets/phones/oppo.jpg',
            'Honor Magic6 Pro'        => '/assets/phones/honor.jpg',
            // Notebooky
            'MacBook Pro 14'          => '/assets/notebook.jpg',
            'Dell XPS 15'             => '/assets/notebook.jpg',
            'Lenovo ThinkPad X1'      => '/assets/notebook.jpg',
            'ASUS ROG Zephyrus'       => '/assets/notebook.jpg',
            'HP Spectre x360'         => '/assets/notebook.jpg',
            // Príslušenstvo
            'AirPods Pro 2'           => '/assets/airpods.jpg',
            'USB-C Nabíjací kábel'    => '/assets/cable.jpg',
            'Rýchla nabíjačka 65W'   => '/assets/charger.jpg',
            'Apple Watch Series 9'    => '/assets/watch.jpg',
            // Spotrebiče
            'Samsung Chladnička RF65' => '/assets/fridge.jpg',
            'LG Práčka F4WV710S2E'   => '/assets/washing.jpg',
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
