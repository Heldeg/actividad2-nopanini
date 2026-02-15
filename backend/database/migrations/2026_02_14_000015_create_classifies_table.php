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
        Schema::create('classifies', function (Blueprint $table) {
            $table->unsignedBigInteger('property_id');
            $table->string('isbn', 20);

            

            $table->foreign('property_id')
                ->references('category_id')
                ->on('categories')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('isbn')
                ->references('isbn')
                ->on('books')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->primary(['property_id', 'isbn']);
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classifies');
    }
};
