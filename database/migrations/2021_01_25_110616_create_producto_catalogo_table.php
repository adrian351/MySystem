<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoCatalogoTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
      Schema::create('producto_catalogo', function (Blueprint $table) {
        $table->unsignedBigInteger('producto_id')->comment('id del producto');
        $table->unsignedBigInteger('catalogo_id')->comment('Foreign Key');
        $table->foreign('producto_id')->references('id')->on('productos')->onUpdate('restrict')->onDelete('cascade');
        $table->foreign('catalogo_id')->references('id')->on('catalogos')->onUpdate('restrict')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto_catalogo');
    }
}
