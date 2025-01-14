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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_user_id')->nullable(); // المستخدم المرسل
            $table->unsignedBigInteger('to_user_id')->nullable(); // المستخدم المستلم
            $table->decimal('amount', 15, 2); // المبلغ
            $table->string('note')->nullable(); 
            $table->tinyInteger('payment_done')->default('1');
            $table->timestamps();
        
            // العلاقات
            $table->foreign('from_user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('to_user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
