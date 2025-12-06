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
		Schema::create('branch', function (Blueprint $table) {
			$table->id();
			$table->string('nama_branch');
			$table->string('alamat');
			$table->string('kota');
			$table->string('provinsi');
			$table->string('gambar_branch')->nullable();
			$table->text('gambar_branch_desc')->nullable();
			$table->string('phone_num')->nullable();
			$table->string('instagram')->nullable();
			$table->string('link_instagram')->nullable();
			$table->string('facebook')->nullable();
			$table->string('link_facebook')->nullable();
			$table->string('link_gmaps')->nullable();
			$table->string('email')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('branch');
	}
};


