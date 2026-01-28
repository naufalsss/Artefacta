<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Artifact;
use App\Models\Gallery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CategorySeeder::class);
        $this->call(MenuSeeder::class);

        // Create admin user
        User::factory()->create([
            'name' => 'Mohammad Naufal Murfid',
            'email' => 'mohammadnaufalmurfid@gmail.com',
            'jenis_kelamin' => 'Laki-laki',
            'umur' => 18,
            'status' => 'active',
            'role' => 'admin',
            'password' => bcrypt('naufal123#'),
        ]);

        User::factory()->create([
            'name' => 'Aurellia Ledy Ulhaq',
            'email' => 'aurellialedyul05122gmail.com',
            'jenis_kelamin' => 'Perempuan',
            'umur' => 19,
            'status' => 'active',
            'role' => 'admin',
            'password' => bcrypt('aurel0512'),
        ]);


        // Create sample artifacts
        $artifacts = [
            [
                'name' => 'Lukisan Tradisional',
                'description' => 'Koleksi lukisan tradisional dari abad ke-19',
            ],
            [
                'name' => 'Patung Kuno',
                'description' => 'Patung bersejarah dari era pra-kemerdekaan',
            ],
            [
                'name' => 'Batik Klasik',
                'description' => 'Batik dengan motif klasik Jawa',
            ],
        ];

        foreach ($artifacts as $artifact) {
            Artifact::create($artifact);
        }

        // Create sample galleries
        $galleries = [
            [
                'title' => 'Galeri Pertama',
                'description' => 'Ini adalah galeri pertama kami yang menampilkan koleksi seni tradisional',
                'artifact_id' => 1,
                'is_published' => true,
            ],
            [
                'title' => 'Galeri Kedua',
                'description' => 'Koleksi patung kuno yang sangat berharga',
                'artifact_id' => 2,
                'is_published' => false,
            ],
        ];

        foreach ($galleries as $gallery) {
            Gallery::create($gallery);
        }
    }
}
