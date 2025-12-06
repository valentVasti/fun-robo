<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
	public function run(): void
	{
		$items = [
			['question' => 'What is FunRobo?', 'answer' => 'A place to learn robotics and programming.'],
			['question' => 'How to join?', 'answer' => 'Contact our main branch via WhatsApp.'],
			['question' => 'What age is suitable?', 'answer' => 'From 6 years and above.'],
			['question' => 'Do you provide competitions?', 'answer' => 'Yes, we participate in multiple events and competitions.'],
		];

		foreach ($items as $qna) {
			Faq::updateOrCreate(['question' => $qna['question']], ['answer' => $qna['answer']]);
		}
	}
}


