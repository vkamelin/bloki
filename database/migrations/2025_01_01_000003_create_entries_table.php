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
        Schema::create('entries', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->unsignedBigInteger('collection_id');
            $table->string('handle');
            $table->string('slug');
            $table->string('name');
            $table->string('title')->nullable();
            $table->enum('status', ['draft', 'published', 'review', 'archived'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->json('meta')->nullable();
            $table->boolean('is_active')->default(false);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('collection_id');
            $table->index('slug');
            $table->index('status');
            $table->index('published_at');
            $table->index('created_by');
            $table->index('updated_by');

            // Foreign keys
            $table->foreign('collection_id')->references('id')->on('collections')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('admins')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('admins')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entries');
    }
};
