<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\ArticleImage;

class ArticleImageSeeder extends Seeder
{
	public function run(): void
	{
		$articles = Article::orderBy('id')->get();
		if ($articles->count() === 0) {
			return;
		}

		$images = [
			[ 'num' => 1, 'path' => '1702018353_image1article_awards-3.jpg', 'caption' => 'Awards 3', 'image_desc' => 'Awards photo' ],
			[ 'num' => 2, 'path' => '1702018425_image2article_Project-BR1.png', 'caption' => 'Project BR1', 'image_desc' => 'Project image' ],
		];

		foreach ($articles as $i => $article) {
			foreach ($images as $img) {
				ArticleImage::updateOrCreate(
					['id_artikel' => $article->id, 'num' => $img['num']],
					[ 'path' => $img['path'], 'caption' => $img['caption'], 'image_desc' => $img['image_desc'] ]
				);
			}
		}
	}
}


