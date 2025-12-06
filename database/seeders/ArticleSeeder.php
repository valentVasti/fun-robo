<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
	public function run(): void
	{
		$now = now();
		$articles = [
			[
				'penulis' => 'Admin',
				'judul' => 'Welcome to FunRobo',
				'isi' => '<p>Intro to FunRobo and our mission.</p> [img] <p>More content here.</p>',
				'thumbnail' => '1701766036_thumbnailImg_1701060834_cover_IMG_2594.JPG',
				'thumbnail_desc' => 'Cover image',
				'thumbnail_caption' => 'FunRobo Cover',
				'highlighted' => 1,
				'created_at' => $now,
				'updated_at' => $now,
			],
			[
				'penulis' => 'Editor',
				'judul' => 'Robotics for Kids',
				'isi' => '<p>Why robotics education matters.</p> [img] <p>Hands-on learning.</p>',
				'thumbnail' => '1702617216_thumbnailImg_download.jpeg',
				'thumbnail_desc' => 'Robotics kids',
				'thumbnail_caption' => 'Learning Robotics',
				'highlighted' => 0,
				'created_at' => $now,
				'updated_at' => $now,
			],
			[
				'penulis' => 'Reporter',
				'judul' => 'Competition Highlights',
				'isi' => '<p>Recent achievements and awards.</p> [img] <p>See the gallery.</p>',
				'thumbnail' => '1702617502_thumbnailImg_BTech-Mechanical-Engineering-Robotics-AI.png',
				'thumbnail_desc' => 'Competition',
				'thumbnail_caption' => 'Awards & Events',
				'highlighted' => 1,
				'created_at' => $now,
				'updated_at' => $now,
			],
		];

		foreach ($articles as $data) {
			Article::create($data);
		}
	}
}


