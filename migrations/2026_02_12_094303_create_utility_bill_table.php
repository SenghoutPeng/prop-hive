<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('utility_bill', function (Blueprint $table) {
            $table->id('utility_bill_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('property_id');
            $table->string('utility_bill_type')->nullable();
            $table->bigInteger('utility_bill_usage')->nullable();
            $table->bigInteger('utility_bill_amount')->nullable();
            $table->dateTime('utility_bill_date')->nullable();
            $table->dateTime('utility_bill_due_date')->nullable();
            $table->string('utility_bill_status')->nullable();
            
            $table->foreign('user_id')->references('user_id')->on('user');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('utility_bill');
    }
};