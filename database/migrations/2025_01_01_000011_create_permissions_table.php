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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('collection_id')->nullable();
            $table->unsignedBigInteger('field_group_id')->nullable();
            $table->enum('action', ['read', 'write', 'delete']);

            // Indexes
            $table->index('role_id');
            $table->index('collection_id');
            $table->index('field_group_id');

            // Foreign keys
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('collection_id')->references('id')->on('collections')->onDelete('cascade');
            $table->foreign('field_group_id')->references('id')->on('field_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop foreign keys first
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropForeign(['collection_id']);
            $table->dropForeign(['field_group_id']);

            $table->dropIndex(['role_id']);
            $table->dropIndex(['collection_id']);
            $table->dropIndex(['field_group_id']);
        });

        Schema::dropIfExists('permissions');
    }
};
