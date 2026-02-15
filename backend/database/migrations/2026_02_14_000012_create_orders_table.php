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
            $table->id();
            $table->decimal('total', 10, 2);
            $table->enum('type', ['online', 'physical']);

            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id')
                ->references('client_id')
                ->on('clients')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id')
                ->references('employee_id')
                ->on('employees')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreignId('library_id')->constrained('libraries')
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
