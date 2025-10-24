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
        Schema::create('waitlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('book_id')->constrained('books');
            $table->integer('position');
            $table->timestamp('joined_at');
            $table->string('status "Active/Assigned/Skipped"')->default('Active');
            $table->timestamps();
        });
    }
/*
bigint id PK
        bigint user_id FK
        bigint book_id FK
        integer position
        timestamp joined_at
        enum status "Active,Assigned,Skipped"
        timestamp created_at
        timestamp updated_at
*/
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waitlists');
    }
};
