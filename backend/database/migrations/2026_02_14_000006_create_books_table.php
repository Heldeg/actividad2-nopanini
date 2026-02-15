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
        Schema::create('books', function (Blueprint $table) {
            $table->string('isbn', 20);
            $table->primary('isbn');
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->string('edition_num', 255);
            $table->string('language', 100);
            $table->decimal('price', 10, 2);
            $table->string('cover_image', 255)->nullable();
            $table->unsignedBigInteger('editorial_id');

            $table->foreign('editorial_id')
                ->references('editorial_id')
                ->on('editorials')
                ->onDelete('restrict')
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
        Schema::dropIfExists('books');
    }
};
