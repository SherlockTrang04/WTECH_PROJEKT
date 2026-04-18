<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $smartfony = Category::where('name', 'Smartfóny')->first()->id;
        $notebooky = Category::where('name', 'Notebooky')->first()->id;

        $products = [
            ['category_id' => $smartfony, 'name' => 'iPhone 15 Pro', 'brand' => 'Apple', 'color' => 'Čierna', 'price' => 1299.99, 'stock' => 10, 'stars' => 5, 'description' => 'Vlajkový smartfón Apple s čipom A17 Pro.'],
            ['category_id' => $smartfony, 'name' => 'Samsung Galaxy S24', 'brand' => 'Samsung', 'color' => 'Sivá', 'price' => 999.99, 'stock' => 15, 'stars' => 4, 'description' => 'Výkonný Android smartfón so 200MP fotoaparátom.'],
            ['category_id' => $smartfony, 'name' => 'Xiaomi 14', 'brand' => 'Xiaomi', 'color' => 'Biela', 'price' => 799.99, 'stock' => 20, 'stars' => 3, 'description' => 'Prémiový smartfón s Leica fotoaparátom.'],
            ['category_id' => $smartfony, 'name' => 'Google Pixel 8', 'brand' => 'Google', 'color' => 'Zelená', 'price' => 749.99, 'stock' => 8, 'stars' => 2, 'description' => 'Smartfón s najlepším AI fotoaparátom.'],
            ['category_id' => $smartfony, 'name' => 'OnePlus 12', 'brand' => 'OnePlus', 'color' => 'Čierna', 'price' => 849.99, 'stock' => 12, 'stars' => 4, 'description' => 'Rýchle nabíjanie 100W, Snapdragon 8 Gen 3.'],
            ['category_id' => $notebooky, 'name' => 'MacBook Pro 14', 'brand' => 'Apple', 'color' => 'Strieborná', 'price' => 2199.99, 'stock' => 5, 'stars' => 5, 'description' => 'Profesionálny notebook s čipom M3 Pro.'],
            ['category_id' => $notebooky, 'name' => 'Dell XPS 15', 'brand' => 'Dell', 'color' => 'Čierna', 'price' => 1799.99, 'stock' => 7, 'stars' => 4, 'description' => 'OLED displej, Intel Core i7, 32GB RAM.'],
            ['category_id' => $notebooky, 'name' => 'Lenovo ThinkPad X1', 'brand' => 'Lenovo', 'color' => 'Čierna', 'price' => 1599.99, 'stock' => 9, 'stars' => 4, 'description' => 'Biznis notebook s výbornou klávesnicou.'],
            ['category_id' => $notebooky, 'name' => 'ASUS ROG Zephyrus', 'brand' => 'ASUS', 'color' => 'Sivá', 'price' => 2499.99, 'stock' => 4, 'stars' => 5, 'description' => 'Herný notebook RTX 4080, 240Hz displej.'],
            ['category_id' => $notebooky, 'name' => 'HP Spectre x360', 'brand' => 'HP', 'color' => 'Strieborná', 'price' => 1399.99, 'stock' => 6, 'stars' => 4, 'description' => '2-v-1 konvertibilný notebook s OLED dotykovým displejom.'],
        ];

        foreach ($products as $data) {
            Product::create(array_merge($data, ['is_active' => true]));
        }
    }
}
