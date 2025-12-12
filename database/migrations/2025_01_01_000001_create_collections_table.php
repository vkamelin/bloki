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
            $table->string('handle')->unique();
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->string('icon')->nullable();

            // Settings JSON
            $table->boolean('has_sections')->default(true);
            $table->enum('section_structure', ['tree', 'single'])->default('tree');
            $table->json('entry_behavior')->nullable();
            $table->boolean('is_singleton')->default(false);
            $table->boolean('full_text_search')->default(false);

            // Views JSON
            $table->string('default_template_section')->nullable();
            $table->string('default_template_entry')->nullable();
            $table->json('route_patterns')->nullable();
            $table->json('api_visibility')->nullable();

            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->softDeletes();

            $table->timestamps();
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
