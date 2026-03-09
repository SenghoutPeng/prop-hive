<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191);
            $table->string('position', 191);
            $table->text('bio')->nullable();
            $table->string('image', 191)->nullable();
            $table->string('email', 191)->nullable();
            $table->string('phone', 191)->nullable();
            $table->string('linkedin', 191)->nullable();
            $table->string('twitter', 191)->nullable();
            $table->string('facebook', 191)->nullable();
            $table->string('status', 191)->default('active');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            $table->index('status');
            $table->index('sort_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};