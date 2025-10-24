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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('book_id')->constrained('books');
            $table->timestamp('reserved_at');
            $table->timestamp('expires_at');
            $table->string('status "Pending/Confirmed/Expired"')->default('Pending');
            $table->timestamps();
        });
    }
/*
bigint id PK
        bigint user_id FK
        bigint book_id FK
        timestamp reserved_at
        timestamp expires_at
        enum status "Pending,Confirmed,Expired"
        timestamp created_at
        timestamp updated_at
*/

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
