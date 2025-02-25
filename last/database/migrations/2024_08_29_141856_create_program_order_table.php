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
        Schema::create('program_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('program_id');
            $table->integer('user_id');
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->decimal('price', 8, 4);
                        $table->integer('count')->nullable();
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
        Schema::dropIfExists('program_orders');
    }
};
