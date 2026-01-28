<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Category;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $coffeeCategory = Category::where('name', 'Coffee')->first();

        if ($coffeeCategory) {
            Menu::create([
                'name' => 'Espresso Artefacta',
                'description' => 'Espresso khas dengan biji kopi pilihan.',
                'price' => 28000,
                'category_id' => $coffeeCategory->id,
                'is_signature' => true
            ]);

            Menu::create([
                'name' => 'Caramel Latte',
                'description' => 'Latte lembut dengan caramel manis.',
                'price' => 32000,
                'category_id' => $coffeeCategory->id,
                'is_signature' => false
            ]);
        }
    }
}

