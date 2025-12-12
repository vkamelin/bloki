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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->unsignedBigInteger('collection_id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedInteger('lft')->default(0);
            $table->unsignedInteger('rgt')->default(0);
            $table->string('slug', 100);
            $table->string('name', 100);
            $table->string('title', 200)->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['published', 'hidden', 'archived'])->default('published');
            $table->json('meta')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('collection_id');
            $table->index('parent_id');
            $table->index('lft');
            $table->index('rgt');
            $table->index('slug');
            $table->index('created_by');
            $table->index('updated_by');

            // Foreign keys
            $table->foreign('collection_id')->references('id')->on('collections')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('admins')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('admins')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
