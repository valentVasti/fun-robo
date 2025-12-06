<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
	public function run(): void
	{
		$tags = [
			'Robotics',
			'Programming',
			'Events',
			'Awards',
			'Education',
		];

		foreach ($tags as $name) {
			Tag::updateOrCreate(['tag_name' => $name]);
		}
	}
}


