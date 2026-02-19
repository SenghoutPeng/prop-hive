<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('utility_request', function (Blueprint $table) {
            $table->id('utility_request_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('property_id');
            $table->text('utility_request_description');
            $table->string('utility_request_status');
            $table->timestamp('utility_request_created_at')->nullable();
            $table->timestamp('utility_request_responded_at')->nullable();
            
            $table->foreign('user_id')->references('user_id')->on('user');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('utility_request');
    }
};