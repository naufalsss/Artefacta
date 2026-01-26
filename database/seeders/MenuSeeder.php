<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        Menu::create([
            'name' => 'Espresso Artefacta',
            'description' => 'Espresso khas dengan biji kopi pilihan.',
            'price' => 28000,
            'category' => 'Coffee',
            'is_signature' => true
        ]);

        Menu::create([
            'name' => 'Caramel Latte',
            'description' => 'Latte lembut dengan caramel manis.',
            'price' => 32000,
            'category' => 'Coffee',
            'is_signature' => false
        ]);
    }
}

