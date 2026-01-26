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
        $this->call(MenuSeeder::class);

        // Create admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'jenis_kelamin' => 'Laki-laki',
            'umur' => 30,
            'status' => 'active',
            'role' => 'admin',
            'password' => bcrypt('password123'),
        ]);

        // Create regular user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'jenis_kelamin' => 'Perempuan',
            'umur' => 25,
            'status' => 'active',
            'role' => 'user',
            'password' => bcrypt('password123'),
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
