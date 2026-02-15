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
        Schema::create('employees', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_id');
            $table->primary('employee_id');
            $table->string('dni', 100)->unique();
            $table->string('tel_number', 200);
            $table->string('bank_account', 200);


            $table->foreign('employee_id')
              ->references('id') // Apunta al 'id' de la tabla users
              ->on('users')
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
        Schema::dropIfExists('employees');
    }
};
