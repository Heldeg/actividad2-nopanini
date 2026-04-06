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
        Schema::create('contain', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->string('isbn', 20);
            $table->integer('quantity');
            $table->primary(['order_id', 'isbn']);
            $table->foreign('order_id')
                ->references('order_id')
                ->on('orders')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('isbn')
                ->references('isbn')
                ->on('book')
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
        Schema::dropIfExists('contain');
    }
};
