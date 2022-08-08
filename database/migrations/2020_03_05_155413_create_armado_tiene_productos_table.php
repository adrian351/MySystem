<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArmadoTieneProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('armado_tiene_productos', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->integer('cant')->unsigned()->default(1)->comment('Cantidad de productos');
            $table->unsignedBigInteger('armado_id')->comment('Foreign Key armados');
            $table->unsignedBigInteger('producto_id')->comment('Foreign Key productos');
            $table->foreign('armado_id')->references('id')->on('armados')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('productos')->onUpdate('restrict')->onDelete('cascade');
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
        Schema::dropIfExists('armado_tiene_productos');
    }
}
