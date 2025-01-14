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
        Schema::create('tweetcell_kontor_orders', function (Blueprint $table) {
            $table->id();
            
            $table->integer('tweetcell_kontor_id');
            $table->integer('user_id');
            $table->foreign('tweetcell_kontor_id')->references('id')->on('tweetcell_kontors')->onDelete('cascade');
            $table->string('mobile');
            $table->decimal('price', 10, 2);
            $table->string('note')->nullable();
            
            $table->string('status')->nullable()->default('قيد المراجعة');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tweetcell_kontor_orders');
    }
};
