<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Awards;
use App\Models\AwardsImage;

class AwardsImageSeeder extends Seeder
{
	public function run(): void
	{
		$awards = Awards::orderBy('id')->get();
		if ($awards->count() === 0) {
			return;
		}

		$imagesByAward = [
			[
				['path' => '1702010476lorem_image1_awards-3.jpg', 'image_desc' => 'Award image 1'],
				['path' => '1702010476lorem_image2_awards-2.jpg', 'image_desc' => 'Award image 2'],
			],
			[
				['path' => '1701766906b_image1_WhatsAppImage2023-11-28at12.01.48_df99e6d1.jpg', 'image_desc' => 'Hackathon image 1'],
				['path' => '1701766906b_image2_pexels-nur-andi-ravsanjani-gusma-804408.jpg', 'image_desc' => 'Hackathon image 2'],
			],
		];

		foreach ($awards as $index => $award) {
			$imgs = $imagesByAward[$index] ?? [];
			foreach ($imgs as $img) {
				AwardsImage::updateOrCreate(
					['id_awards' => $award->id, 'path' => $img['path']],
					['image_desc' => $img['image_desc']]
				);
			}
		}
	}
}


