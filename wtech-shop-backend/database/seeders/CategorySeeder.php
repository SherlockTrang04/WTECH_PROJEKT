<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Smartfóny',
            'Notebooky',
            'Počítače',
            'Príslušenstvo',
            'Spotrebiče',
        ];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
