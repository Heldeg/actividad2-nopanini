<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->string('isbn')->after('library_id'); 
            $table->foreign('isbn')->references('isbn')->on('books')->onDelete('cascade');
        });

        Schema::dropIfExists('belongs');
    }

    public function down(): void
    {
        Schema::create('belongs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inventory_id');
            $table->string('isbn');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('inventories', function (Blueprint $table) {
            $table->dropForeign(['isbn']);
            $table->dropColumn('isbn');
        });
    }
};
