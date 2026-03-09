<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_us', function (Blueprint $table) {
            $table->id('contact_us_id');
            $table->string('contact_us_name')->nullable();
            $table->string('contact_us_email')->nullable();
            $table->string('contact_us_message')->nullable();
            $table->date('contact_us_submitted_at')->nullable();
            $table->string('contact_us_status')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_us');
    }
};