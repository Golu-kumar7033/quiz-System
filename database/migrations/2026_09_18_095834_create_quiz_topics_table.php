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
        Schema::create('quiz_topics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quize_id')
          ->constrained('category_quizes')
          ->onDelete('cascade');  
            $table->string('Topic');
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_topics');
    }
};
