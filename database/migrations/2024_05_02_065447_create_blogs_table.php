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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('Title');
            $table->string('Slug')->nullable();
            $table->string('Category_id');
            $table->string('Author_id');
            $table->string('Tag_id');
            $table->string('Description');
            $table->string('Description2');
            $table->string('Featured_Image');
            $table->string('Banner_Image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
