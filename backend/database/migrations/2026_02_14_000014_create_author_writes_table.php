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
        Schema::create('author_writes', function (Blueprint $table) {
            $table->unsignedBigInteger('author_id');
            $table->string('isbn', 20);



            $table->foreign('author_id')
                ->references('author_id')
                ->on('authors')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('isbn')
                ->references('isbn')
                ->on('books')
                ->onDelete('restrict')
                ->onUpdate('cascade');
                
            $table->primary(['author_id', 'isbn']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('author_writes');
    }
};
