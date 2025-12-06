<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutUsData;

class AboutUsDataSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		$records = [
			['type' => 'mascot1', 'content' => 'Fani01.png'],
			['type' => 'mascot2', 'content' => 'Robi01.png'],
			['type' => 'longText', 'content' => '<p>We are FunRobo. This is the long about text.</p>'],
			['type' => 'homeText', 'content' => '<p>Short pitch for the homepage hero.</p>'],
			['type' => 'shortText', 'content' => '<p>Short about text used across pages.</p>'],
			['type' => 'image1', 'content' => '1703574644_aboutUs_image1_DSC02242-min(1).JPG'],
			['type' => 'image2', 'content' => '1703574643_aboutUs_image2_DSC02122_2-min-min.JPG'],
			['type' => 'landingImage', 'content' => '1703576098_aboutUs_landingImage_robo-wunderkind-oUgZVBaGcEQ-unsplash.jpg'],
		];

		foreach ($records as $data) {
			AboutUsData::updateOrCreate(
				['type' => $data['type']],
				['content' => $data['content']]
			);
		}
	}
}


