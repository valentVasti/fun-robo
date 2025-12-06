<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Awards;

class AwardsSeeder extends Seeder
{
	public function run(): void
	{
		$items = [
			[
				'achievement' => 'Juara 1',
				'event' => 'WRO',
				'year' => 2023,
				'place' => 'Yogyakarta',
				'type' => 'National'
			],
			[
				'achievement' => 'Juara 2',
				'event' => 'WRO',
				'year' => 2022,
				'place' => 'Jakarta',
				'type' => 'National'
			],
			[
				'achievement' => 'Finalist',
				'event' => 'RoboCup',
				'year' => 2024,
				'place' => 'Bandung',
				'type' => 'International'
			],
		];

		foreach ($items as $a) {
			Awards::updateOrCreate(
				['achievement' => $a['achievement'], 'event' => $a['event'], 'year' => $a['year']],
				$a
			);
		}
	}
}


