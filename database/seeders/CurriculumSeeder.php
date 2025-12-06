<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Curriculum;

class CurriculumSeeder extends Seeder
{
	public function run(): void
	{
		$items = [
			[
				'curriculum_name' => 'Basic Robotics',
				'price' => 250000,
				'duration' => 4,
				'description' => 'Introduction to robotics basics.',
				'details' => "<p>Learn basic electronics and logic.</p>\n<ul>\n<li>Motors and sensors</li>\n<li>Simple circuits</li>\n</ul>",
				'age_min' => 6,
				'age_max' => 9,
				'image_path' => '1703164600_curriculumImg_br.png',
				'image_description' => 'Basic robotics image'
			],
			[
				'curriculum_name' => 'Creative Building',
				'price' => 300000,
				'duration' => 4,
				'description' => 'Creative STEM building projects.',
				'details' => "<p>Design and build creative models.</p>",
				'age_min' => 7,
				'age_max' => 12,
				'image_path' => '1703164012_curriculumImg_cb.png',
				'image_description' => 'Creative building image'
			],
			[
				'curriculum_name' => 'Advanced Robotics',
				'price' => 350000,
				'duration' => 4,
				'description' => 'Advanced programming and robotics.',
				'details' => "<p>Programming and complex mechanisms.</p>",
				'age_min' => 10,
				'age_max' => null,
				'image_path' => '1703164775_curriculumImg_ro.png',
				'image_description' => 'Advanced robotics image'
			],
		];

		foreach ($items as $c) {
			Curriculum::updateOrCreate(
				['curriculum_name' => $c['curriculum_name']],
				$c
			);
		}
	}
}


