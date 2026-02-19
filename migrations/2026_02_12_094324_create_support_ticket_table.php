<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('support_ticket', function (Blueprint $table) {
            $table->id('support_ticket_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('user_email')->nullable();
            $table->string('support_ticket_message')->nullable();
            $table->string('support_ticket_status')->nullable();
            $table->dateTime('support_ticket_created_at')->nullable();
            $table->dateTime('support_ticket_responded_at')->nullable();
            $table->string('name')->nullable();
            
            $table->foreign('user_id')->references('user_id')->on('user');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_ticket');
    }
};