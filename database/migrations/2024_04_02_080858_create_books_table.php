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
        Schema::create('books', function (Blueprint $table) {
            // $table->id();
            $table->uuid('id')->primary();
            $table->text('name');
            $table->string('isbn', 255);
            $table->foreignUuid('category_id')->constrained();
            // $table->bigInteger('category_id');
            $table->foreignUuid('author_id')->constrained();
            // $table->bigInteger('author_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
