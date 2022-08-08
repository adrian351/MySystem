<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoOriginalTieneProductoPedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prod_orig_tiene_prod_ped', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('producto_id')->comment('Foreign Key productos');
            $table->unsignedBigInteger('pedido_armado_tiene_producto_id')->comment('Foreign Key pedido_armado_tiene_productos');
            $table->foreign('producto_id')->references('id')->on('productos')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('pedido_armado_tiene_producto_id')->references('id')->on('pedido_armado_tiene_productos')->onUpdate('restrict')->onDelete('cascade');
            
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
        Schema::dropIfExists('producto_original_tiene_producto_pedido');
    }
}
