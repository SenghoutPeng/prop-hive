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
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('property_id')->nullable();
            $table->decimal('payment_amount', 10, 2);
            $table->date('payment_date');
            $table->string('payment_status')->default('pending');
            $table->string('payment_type');
            $table->text('description')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('user_id')->on('user')->onDelete('cascade');
            $table->foreign('property_id')->references('property_id')->on('properties')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
