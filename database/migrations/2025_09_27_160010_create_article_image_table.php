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
		Schema::create('article_image', function (Blueprint $table) {
			$table->id();
			$table->foreignId('id_artikel')->constrained('article')->cascadeOnDelete();
			$table->integer('num')->default(0);
			$table->string('path');
			$table->string('caption')->nullable();
			$table->text('image_desc')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('article_image');
	}
};


