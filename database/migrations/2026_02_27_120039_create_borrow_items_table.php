<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('borrow_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('borrow_id')
                  ->constrained('borrows')
                  ->onDelete('cascade');
            $table->foreignId('book_id')
                  ->constrained('books')
                  ->onDelete('cascade');
            $table->boolean('returned')->default(false);
            $table->timestamp('returned_at')->nullable();
            $table->decimal('fine', 8, 2)->default(0.00); // recorded fine upon return
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('borrow_items');
    }
};