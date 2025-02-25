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
        Schema::create('ebanks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('image_url')->nullable();

            $table->integer('section_id');
            $table->foreign('section_id')->references('id')->on('ebank_sections')->onDelete('cascade');
            $table->decimal('price', 8, 4);
            $table->string('note')->nullable();
            $table->tinyInteger('status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ebanks');
    }
};
