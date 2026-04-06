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
        Schema::create('category', function (Blueprint $table) {
            $table->unsignedBigInteger('property_id');
            $table->primary('property_id');
            $table->string('name', 200);
            $table->unsignedBigInteger('parent_category')->nullable();
            $table->foreign('parent_category')
                ->references('property_id')
                ->on('category')
                ->onDelete('cascade')
                ->onUpdate('cascade');  
            $table->foreign('property_id')
                ->references('property_id')
                ->on('property')
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
        Schema::dropIfExists('category');
    }
};
