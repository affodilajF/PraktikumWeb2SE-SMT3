<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('kategoribuku', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buku_id');
            $table->unsignedBigInteger('kategori_id');
            $table->timestamps();

            // $table->foreign('buku_id')->references('id')->on('buku')->onDelete('cascade');
            // $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kategoribuku');
    }

};
