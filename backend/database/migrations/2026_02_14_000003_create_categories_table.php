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
        Schema::create('categories', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id');
            $table->primary('category_id');

            $table->string('name', 200);
            $table->unsignedBigInteger('parent_category_id')->nullable();

            $table->foreign('parent_category_id')
                ->references('category_id')
                ->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');  
            $table->foreign('category_id')
                ->references('id')
                ->on('properties')
                ->onDelete('cascade')
                ->onUpdate('cascade');
                
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
