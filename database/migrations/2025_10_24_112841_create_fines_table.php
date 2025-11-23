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
        Schema::create('fines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('borrowed_item_id')->constrained('borrowed_items');
            $table->foreignId('user_id')->constrained('users');
            $table->decimal('amount_due',10,2);
            $table->decimal('amount_paid',10,2);
            $table->date('incurred_on');
            $table->string('status')->default('unpaid');
            $table->timestamps();
        });
    }

/*
bigint id PK
        bigint borrowed_item_id FK
        bigint user_id FK
        decimal amount_due
        decimal amount_paid
        date incurred_on
        enum status "Pending,Paid"
        timestamp created_at
        timestamp updated_at
*/
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fines');
    }
};
