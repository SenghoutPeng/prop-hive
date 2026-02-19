<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('property_type', function (Blueprint $table) {
            $table->id('property_type_id');
            $table->string('property_type_name')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('property_type');
    }
};