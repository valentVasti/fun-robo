<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		$now = now();
		$hasUsername = Schema::hasColumn('users', 'username');
		$hasEmail = Schema::hasColumn('users', 'email');
		$hasName = Schema::hasColumn('users', 'name');

		// Build the admin payload depending on available columns
		$identifierColumn = $hasUsername ? 'username' : ($hasEmail ? 'email' : null);
		$identifierValue = $hasUsername ? 'admin' : ($hasEmail ? 'admin@example.com' : null);

		$payload = [
			'password' => Hash::make('admin123'),
			'remember_token' => Str::random(10),
			'created_at' => $now,
			'updated_at' => $now,
		];

		if ($hasUsername) {
			$payload['username'] = 'admin';
		}
		if ($hasEmail) {
			$payload['email'] = $identifierValue ?? 'admin@example.com';
		}
		if ($hasName) {
			$payload['name'] = 'Administrator';
		}

		if ($identifierColumn !== null && $identifierValue !== null) {
			DB::table('users')->updateOrInsert(
				[$identifierColumn => $identifierValue],
				$payload
			);
		} else {
			// Fallback: insert if table exists without typical identifier columns
			DB::table('users')->insert($payload);
		}
	}
}


