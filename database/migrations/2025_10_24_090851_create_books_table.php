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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories');
            $table->string('title');
            $table->string('author');
            $table->string('ISBN')->unique();
            $table->string('edition');
            $table->integer('publication_year');
            $table->integer('total_copies');
            $table->integer('available_copies');
            $table->boolean('manual_sync_flag')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

/*
bigint id PK
        bigint category_id FK
        string title
        string author
        string ISBN UK
        string edition
        integer publication_year
        integer total_copies
        integer available_copies
        boolean manual_sync_flag
        timestamp created_at
        timestamp updated_at
        timestamp deleted_at
*/

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
