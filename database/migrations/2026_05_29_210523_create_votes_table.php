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
    Schema::create('votes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('participation_id')->constrained()->cascadeOnDelete();
        $table->dateTime('registered_at');
        $table->text('encrypted_value')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
