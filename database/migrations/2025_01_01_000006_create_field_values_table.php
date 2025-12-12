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
        Schema::create('field_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('field_id');
            $table->string('entity_type');
            $table->unsignedBigInteger('entity_id');
            $table->enum('value_type', ['string', 'text', 'integer', 'float', 'boolean', 'json', 'date', 'datetime']);
            $table->string('value_string', 255)->nullable();
            $table->text('value_text')->nullable();
            $table->integer('value_int')->nullable();
            $table->float('value_float')->nullable();
            $table->boolean('value_bool')->nullable();
            $table->json('value_json')->nullable();
            $table->date('value_date')->nullable();
            $table->dateTime('value_datetime')->nullable();
            $table->string('locale', 10)->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['entity_type', 'entity_id']);
            $table->index('field_id');
            $table->index('locale');

            // Foreign keys
            $table->foreign('field_id')->references('id')->on('fields')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('field_values', function (Blueprint $table) {
            $table->dropForeign('field_id');

            $table->dropIndex(['entity_type', 'entity_id']);
            $table->dropForeign('field_id');
            $table->dropIndex('locale');
        });

        Schema::dropIfExists('field_values');
    }
};
