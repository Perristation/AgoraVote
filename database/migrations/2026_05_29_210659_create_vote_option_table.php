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
    Schema::create('vote_option', function (Blueprint $table) {
        $table->id();
        $table->foreignId('vote_id')->constrained()->cascadeOnDelete();
        $table->foreignId('vote_option_id')->constrained()->cascadeOnDelete();
        $table->timestamps();

        $table->unique(['vote_id', 'vote_option_id']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vote_option');
    }
};
