<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Benefit;

class BenefitSeeder extends Seeder
{
	public function run(): void
	{
		$items = [
			['benefit' => 'Hands-on projects to spark curiosity', 'mascot_path' => 'Fani02.png'],
			['benefit' => 'Learn programming fundamentals', 'mascot_path' => 'Robi03.png'],
			['benefit' => 'Teamwork and problem solving', 'mascot_path' => 'Fani04.png'],
		];

		foreach ($items as $b) {
			Benefit::updateOrCreate(['benefit' => $b['benefit']], ['mascot_path' => $b['mascot_path']]);
		}
	}
}


