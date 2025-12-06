<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
	public function run(): void
	{
		Branch::updateOrCreate(
			['nama_branch' => 'Kantor Pusat'],
			[
				'alamat' => 'Jl. Contoh No. 1',
				'kota' => 'Yogyakarta',
				'provinsi' => 'DI Yogyakarta',
				'gambar_branch' => '1703231245_gambarBranch_IMG-20230826-WA0027.jpg',
				'gambar_branch_desc' => 'Main branch building',
				'phone_num' => '628123456789',
				'instagram' => '@funrobo.id',
				'link_instagram' => 'https://www.instagram.com/funrobo.id',
				'facebook' => 'FunRobo Official',
				'link_facebook' => 'https://www.facebook.com/funrobo.id',
				'link_gmaps' => 'https://maps.google.com',
				'email' => 'info@funrobo.id',
			]
		);
	}
}


