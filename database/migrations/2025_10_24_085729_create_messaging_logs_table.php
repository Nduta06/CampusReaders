<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messaging_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('type "sms/email"');
            $table->string('recipient');
            $table->text('content');
            $table->timestamp('sent_at')->nullable();
            $table->string('status "sent/failed"');
            $table->timestamps();
        });
    }
/*
messaging_logs {
        bigint id PK
        bigint user_id FK
        enum type "SMS,Email"
        string recipient
        text content
        timestamp sent_at
        enum status "Sent,Failed"
        timestamp created_at
        timestamp updated_at
    }
*/

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messaging_logs');
    }
};
