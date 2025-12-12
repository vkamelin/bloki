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
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('name', 100);
            $table->string('slug', 100)->unique();
            $table->text('description')->nullable();
            $table->string('icon')->nullable();

            // Settings JSON
            $table->boolean('has_sections')->default(true);
            $table->enum('section_structure', ['tree', 'single'])->default('tree');
            $table->json('entry_behavior')->nullable();
            +
            $table->boolean('is_singleton')->default(false);
            $table->boolean('full_text_search')->default(false);

            // Views JSON
            $table->string('default_template_section', 100)->nullable();
            $table->string('default_template_entry', 100)->nullable();
            $table->json('route_patterns')->nullable();
            $table->json('api_visibility')->nullable();

            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->softDeletes();

            $table->timestamps();

            // Indexes
            $table->index('is_active');

            // Foreign keys
            $table->foreign('created_by')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collections');
    }
};
