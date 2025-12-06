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
		Schema::create('awards_images', function (Blueprint $table) {
			$table->id();
			$table->foreignId('id_awards')->constrained('awards')->cascadeOnDelete();
			$table->string('path');
			$table->text('image_desc')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('awards_images');
	}
};


