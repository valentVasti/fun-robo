<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('curriculum', function (Blueprint $table) {
			$table->id();
			$table->string('curriculum_name');
			$table->unsignedInteger('price');
			$table->unsignedInteger('duration');
			$table->text('description')->nullable();
			$table->text('details')->nullable();
			$table->unsignedTinyInteger('age_min')->nullable();
			$table->unsignedTinyInteger('age_max')->nullable();
			$table->string('image_path')->nullable();
			$table->text('image_description')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('curriculum');
	}
};


