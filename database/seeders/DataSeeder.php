<?php

namespace Database\Seeders;

use App\Models\Artifact;
use App\Models\Gallery;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Artifacts
        $artifact = Artifact::firstOrCreate(
            ['id' => 4],
            [
                'name' => 'LUKISAN',
                'description' => 'Sebuah karya seni rupa dua dimensi yang diciptakan melalu proses visual ekspresif',
            ]
        );

        // Seed Galleries
        $galleries = [
            [
                'title' => 'Monalisa',
                'description' => 'Lukisan wanita karya leonardo davinci',
                'image_path' => 'galleries/V2RKGgHVLRK5M8aXdlLXJxVTL6vQG54fYkeuNMsr.jpg',
                'artifact_id' => 4,
                'is_published' => true,
                'crop_x' => 0,
                'crop_y' => 0,
                'crop_width' => null,
                'crop_height' => null,
            ],
            [
                'title' => 'Lady With an Ermine',
                'description' => 'Lukisan wanita karya leonardo davinci',
                'image_path' => 'galleries/Yux9CBscVOlCBWp6dHyViEN5D6LeeMJEl76YLBYr.jpg',
                'artifact_id' => 4,
                'is_published' => true,
                'crop_x' => 0,
                'crop_y' => 0,
                'crop_width' => null,
                'crop_height' => null,
            ],
            [
                'title' => 'Leonardo da vinci',
                'description' => 'Pelukis terkenal asal Italia',
                'image_path' => 'galleries/a1ev4338b3e2vGWCLN9L88rjBDmpnP2LsLMRSHKc.jpg',
                'artifact_id' => 4,
                'is_published' => false,
                'crop_x' => 0,
                'crop_y' => 120,
                'crop_width' => 284,
                'crop_height' => 213,
            ],
        ];

        foreach ($galleries as $galleryData) {
            Gallery::firstOrCreate(
                [
                    'title' => $galleryData['title'],
                    'image_path' => $galleryData['image_path'],
                ],
                $galleryData
            );
        }

        $this->command->info('Data seeded successfully!');
    }
}
