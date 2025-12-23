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
        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id');
            $table->uuid();
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->text('instructions')->nullable();
            $table->string('type', 50); // Field types are loaded from configuration, not hardcoded
            $table->json('settings')->nullable();
            $table->boolean('required')->default(false);
            $table->json('validation_rules')->nullable();
            $table->boolean('list_visibility')->default(true);
            $table->boolean('translatable')->default(false);
            $table->boolean('searchable')->default(false);
            $table->boolean('is_active')->default(false);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('group_id');
            $table->index('type');

            // Foreign keys
            $table->foreign('group_id')->references('id')->on('field_groups')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('admins')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('admins')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fields', function (Blueprint $table) {
            $table->dropForeign('group_id');
            $table->dropForeign('created_by');
            $table->dropForeign('updated_by');

            $table->dropIndex(['group_id']);
            $table->dropIndex(['type']);
        });

        Schema::dropIfExists('fields');
    }
};
