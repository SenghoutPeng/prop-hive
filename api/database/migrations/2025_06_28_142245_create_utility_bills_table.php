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
        Schema::create('utility_bills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('property_id')->nullable();
            $table->string('bill_type');
            $table->decimal('usage', 10, 2)->nullable();
            $table->decimal('amount', 10, 2);
            $table->date('bill_date');
            $table->date('due_date');
            $table->string('status')->default('unpaid');
            $table->timestamps();
            
            $table->foreign('user_id')->references('user_id')->on('user')->onDelete('cascade');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utility_bills');
    }
};
