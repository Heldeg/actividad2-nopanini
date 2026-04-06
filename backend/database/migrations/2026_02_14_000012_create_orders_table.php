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
        Schema::create('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id')->autoIncrement()->primary();
            $table->decimal('total', 10, 2);
            $table->enum('type', ['online', 'physical']);
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')
                ->references('client_id')
                ->on('client')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')
                ->references('employee_id')
                ->on('employee')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('library_id');
            $table->foreign('library_id')
                ->references('library_id')
                ->on('library')
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
        Schema::dropIfExists('orders');
    }
};
