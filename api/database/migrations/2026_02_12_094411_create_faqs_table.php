<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id('FAQs_id');
            $table->string('FAQs_question')->nullable();
            $table->string('FAQs_answer')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};