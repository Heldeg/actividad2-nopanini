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
        Schema::create('author', function (Blueprint $table) {
            $table->unsignedBigInteger('property_id');
            $table->primary('property_id');

            $table->string('full_name', 255);
            $table->enum('gender',['M','F','O']);
            $table->string('country', 150);
            $table->date('birth_date');
            $table->date('death_date')->nullable();
            
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
        Schema::dropIfExists('author');
    }
};
