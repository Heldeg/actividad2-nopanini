<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('preferences', function (Blueprint $table) {
            $table->foreignId('property_id')->constrained('properties')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('client_id');

            $table->foreign('client_id')
                ->references('client_id')
                ->on('clients')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->primary(['property_id', 'client_id']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preferences');
    }
};
