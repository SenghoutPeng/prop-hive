<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('property_renting', function (Blueprint $table) {
            $table->id('property_renting_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('property_owner_id')->nullable();
            $table->bigInteger('property_renting_amount')->nullable();
            $table->date('property_renting_start_date')->nullable();
            $table->date('property_renting_end_date')->nullable();
            $table->string('rental_status')->nullable();
            
            $table->foreign('user_id')->references('user_id')->on('user');
            $table->foreign('property_owner_id')->references('property_owner_id')->on('property_owner');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('property_renting');
    }
};