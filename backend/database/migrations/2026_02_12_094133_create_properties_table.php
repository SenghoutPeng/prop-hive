<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title', 191);
            $table->text('description');
            $table->decimal('price', 12, 2);
            $table->string('type', 20);
            $table->string('status', 20)->default('available');
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->integer('square_feet')->nullable();
            $table->string('address', 191);
            $table->string('features')->nullable();
            $table->string('images')->nullable();
            $table->bigInteger('owner_id')->nullable();
            $table->foreignId('agent_id')->nullable()->constrained('users')->onDelete('set null');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->unsignedBigInteger('tenant_id')->nullable();
            
            $table->index('status');
            $table->index('type');
            $table->index('price');
            $table->index('owner_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};