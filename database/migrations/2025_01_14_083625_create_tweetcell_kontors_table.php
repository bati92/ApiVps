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
        Schema::create('tweetcell_kontors', function (Blueprint $table) {
            $table->id();
            $table->integer('section_id');
            $table->foreign('section_id')->references('id')->on('tweetcell_kontor_sections')->onDelete('cascade');
            $table->string('name');
            $table->decimal('basic_price', 10, 2);
            $table->decimal('price', 10, 2);
            $table->string('amount');
            $table->string('code');
            $table->string('image')->nullable();
            $table->string('image_url')->nullable();
            $table->tinyInteger('status')->default('1');
            $table->integer('type')->default('1');//1:tam,2:ses,3: FIRSAT SES,4:sms,5:Yds,6:3gCep,
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tweetcell_kontors');
    }
};
