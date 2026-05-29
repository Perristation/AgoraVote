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
    Schema::create('elections', function (Blueprint $table) {
        $table->id();
        $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
        $table->string('title');
        $table->text('description')->nullable();
        $table->dateTime('start_at')->nullable();
        $table->dateTime('end_at')->nullable();
        $table->enum('status', ['draft', 'active', 'closed', 'archived'])->default('draft');
        $table->boolean('is_anonymous')->default(true);
        $table->boolean('show_realtime_results')->default(false);
        $table->enum('voting_type', ['single', 'multiple', 'category_single', 'category_multiple'])->default('single');
        $table->unsignedInteger('max_selections')->default(1);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elections');
    }
};
