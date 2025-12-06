<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimoni;

class TestimoniSeeder extends Seeder
{
	public function run(): void
	{
		$items = [
			[
				'gambar_testimoni' => '1703167515_testiImg_esti5.png',
				'gambar_testimoni_desc' => 'Student testimonial',
				'nama_testimoni' => 'Arif',
				'keterangan_testimoni' => 'Student',
				'umur_testimoni' => 10,
				'isi_testimoni' => 'I love building robots at FunRobo!'
			],
			[
				'gambar_testimoni' => '1703167141_testiImg_cb.png',
				'gambar_testimoni_desc' => 'Parent testimonial',
				'nama_testimoni' => 'Sari',
				'keterangan_testimoni' => 'Parent',
				'umur_testimoni' => 35,
				'isi_testimoni' => 'Great curriculum and mentors.'
			],
			[
				'gambar_testimoni' => '1702010813_testiImg_IMG_1754.png',
				'gambar_testimoni_desc' => 'Alumni testimonial',
				'nama_testimoni' => 'Bima',
				'keterangan_testimoni' => 'Alumni',
				'umur_testimoni' => 16,
				'isi_testimoni' => 'Competitions helped me learn a lot.'
			],
		];

		foreach ($items as $t) {
			Testimoni::updateOrCreate(
				['nama_testimoni' => $t['nama_testimoni']],
				$t
			);
		}
	}
}


