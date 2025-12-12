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
        Schema::create('revisions', function (Blueprint $table) {
            $table->id();
            $table->string('entity_type');
            $table->unsignedBigInteger('entity_id');
            $table->json('data');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamp('timestamp');
            $table->string('note')->nullable();

            // Indexes
            $table->index(['entity_type', 'entity_id']);
            $table->index('created_by');
            $table->index('timestamp');

            // Foreign keys
            $table->foreign('created_by')->references('id')->on('admins')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revisions');
    }
};
