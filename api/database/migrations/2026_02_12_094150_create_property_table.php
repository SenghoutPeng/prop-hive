<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('property', function (Blueprint $table) {
            $table->id('property_id');
            $table->bigInteger('property_size')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('property_title')->nullable();
            $table->string('location')->nullable();
            $table->text('description')->nullable();
            $table->string('property_status')->nullable();
            $table->unsignedBigInteger('property_type_id')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();
            
            $table->foreign('property_type_id')->references('property_type_id')->on('property_type');
            $table->foreign('admin_id')->references('admin_id')->on('admin');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('property');
    }
};