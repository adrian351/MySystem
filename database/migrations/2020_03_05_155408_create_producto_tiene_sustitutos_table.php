<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoTieneSustitutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_tiene_sustitutos', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('producto_id')->comment('Foreign Key productos');
            $table->unsignedBigInteger('sustituto_id')->comment('Foreign Key productos');
            $table->foreign('producto_id')->references('id')->on('productos')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('sustituto_id')->references('id')->on('productos')->onUpdate('restrict')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto_tiene_sustitutos');
    }
}
