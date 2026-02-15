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
        Schema::create('belongs', function (Blueprint $table) {
            $table->foreignId('inventory_id')->constrained('inventories')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('isbn', 20);


            $table->foreign('isbn')->references('isbn')->on('books')
                ->onDelete('cascade')
                ->onUpdate('cascade');
                
            $table->primary(['inventory_id', 'isbn']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('belongs');
    }
};
