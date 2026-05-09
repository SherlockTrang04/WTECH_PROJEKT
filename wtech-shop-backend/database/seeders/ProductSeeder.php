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
        $smartfony    = Category::where('name', 'Smartfóny')->first()->id;
        $notebooky    = Category::where('name', 'Notebooky')->first()->id;
        $prislusenstvo = Category::where('name', 'Príslušenstvo')->first()->id;
        $spotrebice   = Category::where('name', 'Spotrebiče')->first()->id;

        $products = [
            // Smartfóny
            ['category_id' => $smartfony, 'name' => 'iPhone 15 Pro',      'brand' => 'Apple',   'color' => 'Čierna',     'price' => 1299.99, 'stock' => 10, 'stars' => 5, 'description' => 'Vlajkový smartfón Apple s čipom A17 Pro.'],
            ['category_id' => $smartfony, 'name' => 'Samsung Galaxy S24', 'brand' => 'Samsung', 'color' => 'Sivá',        'price' => 999.99,  'stock' => 15, 'stars' => 4, 'description' => 'Výkonný Android smartfón so 200MP fotoaparátom.'],
            ['category_id' => $smartfony, 'name' => 'Xiaomi 14',          'brand' => 'Xiaomi',  'color' => 'Biela',       'price' => 799.99,  'stock' => 20, 'stars' => 3, 'description' => 'Prémiový smartfón s Leica fotoaparátom.'],
            ['category_id' => $smartfony, 'name' => 'Google Pixel 8',     'brand' => 'Google',  'color' => 'Zelená',      'price' => 749.99,  'stock' => 8,  'stars' => 2, 'description' => 'Smartfón s najlepším AI fotoaparátom.'],
            ['category_id' => $smartfony, 'name' => 'OnePlus 12',         'brand' => 'OnePlus', 'color' => 'Čierna',      'price' => 849.99,  'stock' => 12, 'stars' => 4, 'description' => 'Rýchle nabíjanie 100W, Snapdragon 8 Gen 3.'],
            ['category_id' => $smartfony, 'name' => 'Huawei P60 Pro',     'brand' => 'Huawei',  'color' => 'Čierna',      'price' => 899.99,  'stock' => 10, 'stars' => 4, 'description' => 'Smartfón s výnimočným fotoaparátom a elegantným dizajnom.'],
            ['category_id' => $smartfony, 'name' => 'Motorola Edge 40',   'brand' => 'Motorola','color' => 'Modrá',       'price' => 549.99,  'stock' => 18, 'stars' => 3, 'description' => 'Štýlový smartfón s dlhou výdržou batérie.'],
            ['category_id' => $smartfony, 'name' => 'Sony Xperia 5 V',    'brand' => 'Sony',    'color' => 'Čierna',      'price' => 979.99,  'stock' => 7,  'stars' => 4, 'description' => 'Kompaktný smartfón s profesionálnym fotoaparátom.'],
            ['category_id' => $smartfony, 'name' => 'OPPO Find X7',       'brand' => 'OPPO',    'color' => 'Strieborná',  'price' => 849.99,  'stock' => 9,  'stars' => 4, 'description' => 'Výkonný smartfón s rýchlym nabíjaním 100W.'],
            ['category_id' => $smartfony, 'name' => 'Honor Magic6 Pro',   'brand' => 'Honor',   'color' => 'Zelená',      'price' => 799.99,  'stock' => 11, 'stars' => 3, 'description' => 'Smartfón s AI funkciami a 5000mAh batériou.'],

            // Notebooky
            ['category_id' => $notebooky, 'name' => 'MacBook Pro 14',     'brand' => 'Apple',   'color' => 'Strieborná',  'price' => 2199.99, 'stock' => 5,  'stars' => 5, 'description' => 'Profesionálny notebook s čipom M3 Pro.'],
            ['category_id' => $notebooky, 'name' => 'Dell XPS 15',        'brand' => 'Dell',    'color' => 'Čierna',      'price' => 1799.99, 'stock' => 7,  'stars' => 4, 'description' => 'OLED displej, Intel Core i7, 32GB RAM.'],
            ['category_id' => $notebooky, 'name' => 'Lenovo ThinkPad X1', 'brand' => 'Lenovo',  'color' => 'Čierna',      'price' => 1599.99, 'stock' => 9,  'stars' => 4, 'description' => 'Biznis notebook s výbornou klávesnicou.'],
            ['category_id' => $notebooky, 'name' => 'ASUS ROG Zephyrus',  'brand' => 'ASUS',    'color' => 'Sivá',        'price' => 2499.99, 'stock' => 4,  'stars' => 5, 'description' => 'Herný notebook RTX 4080, 240Hz displej.'],
            ['category_id' => $notebooky, 'name' => 'HP Spectre x360',    'brand' => 'HP',      'color' => 'Strieborná',  'price' => 1399.99, 'stock' => 6,  'stars' => 4, 'description' => '2-v-1 konvertibilný notebook s OLED dotykovým displejom.'],

            // Príslušenstvo
            ['category_id' => $prislusenstvo, 'name' => 'AirPods Pro 2',      'brand' => 'Apple',   'color' => 'Biela',   'price' => 249.99, 'stock' => 25, 'stars' => 5, 'description' => 'Bezdrôtové slúchadlá s aktívnym potlačením hluku.'],
            ['category_id' => $prislusenstvo, 'name' => 'USB-C Nabíjací kábel','brand' => 'Anker',  'color' => 'Čierna',  'price' => 19.99,  'stock' => 50, 'stars' => 4, 'description' => 'Odolný opletený kábel USB-C s rýchlym nabíjaním.'],
            ['category_id' => $prislusenstvo, 'name' => 'Rýchla nabíjačka 65W','brand' => 'Anker',  'color' => 'Biela',   'price' => 49.99,  'stock' => 30, 'stars' => 4, 'description' => 'Kompaktná nabíjačka GaN s výkonom 65W.'],
            ['category_id' => $prislusenstvo, 'name' => 'Apple Watch Series 9', 'brand' => 'Apple', 'color' => 'Čierna',  'price' => 449.99, 'stock' => 14, 'stars' => 5, 'description' => 'Inteligentné hodinky s pokročilým sledovaním zdravia.'],

            // Spotrebiče
            ['category_id' => $spotrebice, 'name' => 'Samsung Chladnička RF65',  'brand' => 'Samsung', 'color' => 'Strieborná', 'price' => 1299.99, 'stock' => 5, 'stars' => 4, 'description' => 'Americká chladnička s displejom a výrobníkom ľadu.'],
            ['category_id' => $spotrebice, 'name' => 'LG Práčka F4WV710S2E',     'brand' => 'LG',      'color' => 'Biela',      'price' => 699.99,  'stock' => 8, 'stars' => 4, 'description' => 'Energeticky úsporná práčka s kapacitou 10kg.'],
        ];

        foreach ($products as $data) {
            Product::create(array_merge($data, ['is_active' => true]));
        }
    }
}
