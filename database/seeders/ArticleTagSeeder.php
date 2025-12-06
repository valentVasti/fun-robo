<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Tag;
use App\Models\ArticleTag;

class ArticleTagSeeder extends Seeder
{
	public function run(): void
	{
		$tagMap = Tag::pluck('id', 'tag_name');
		$articles = Article::orderBy('id')->get();

		if ($articles->count() === 0 || $tagMap->count() === 0) {
			return;
		}

		$links = [
			[ $articles[0]->id, $tagMap['Robotics'] ?? $tagMap->first() ],
			[ $articles[1]->id, $tagMap['Education'] ?? $tagMap->first() ],
			[ $articles[2]->id, $tagMap['Events'] ?? $tagMap->first() ],
		];

		foreach ($links as [$articleId, $tagId]) {
			ArticleTag::updateOrCreate(
				['id_article' => $articleId, 'id_tag' => $tagId],
				[]
			);
		}
	}
}


