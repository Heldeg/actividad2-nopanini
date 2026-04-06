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
        Schema::create('inventory', function (Blueprint $table) {
            $table->unsignedBigInteger('inventory_id')->autoIncrement()->primary();
            $table->unsignedBigInteger('library_id');
            $table->foreign('library_id')
                ->references('library_id')
                ->on('library')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->integer('quantity');
            $table->string('location', 100);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};
