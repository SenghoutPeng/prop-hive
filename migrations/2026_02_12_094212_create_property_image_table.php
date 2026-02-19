<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('property_image', function (Blueprint $table) {
            $table->id('image_id');
            $table->unsignedBigInteger('property_id')->nullable();
            $table->string('image_url')->nullable();
            $table->dateTime('uploaded_at')->nullable();
            
            $table->foreign('property_id')->references('property_id')->on('property');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('property_image');
    }
};