<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AboutUsDataSeeder;
use Database\Seeders\AdminUserSeeder;
use Database\Seeders\TagSeeder;
use Database\Seeders\ArticleSeeder;
use Database\Seeders\ArticleTagSeeder;
use Database\Seeders\ArticleImageSeeder;
use Database\Seeders\BranchSeeder;
use Database\Seeders\BenefitSeeder;
use Database\Seeders\CurriculumSeeder;
use Database\Seeders\FaqSeeder;
use Database\Seeders\TestimoniSeeder;
use Database\Seeders\AwardsSeeder;
use Database\Seeders\AwardsImageSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

		$this->call([
			AboutUsDataSeeder::class,
			AdminUserSeeder::class,
			TagSeeder::class,
			ArticleSeeder::class,
			ArticleTagSeeder::class,
			ArticleImageSeeder::class,
			BranchSeeder::class,
			BenefitSeeder::class,
			CurriculumSeeder::class,
			FaqSeeder::class,
			TestimoniSeeder::class,
			AwardsSeeder::class,
			AwardsImageSeeder::class,
		]);
    }
}
