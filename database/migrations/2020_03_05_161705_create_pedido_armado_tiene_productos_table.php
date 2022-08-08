<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoArmadoTieneProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_armado_tiene_productos', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_producto')->comment('id del producto');
            $table->integer('cant')->unsigned()->comment('Cantidad de productos');
            $table->string('produc', 70)->comment('Nombre del producto');
            $table->string('sku',30)->comment('SKU');
            
            $table->unsignedBigInteger('pedido_armado_id')->comment('Foreign Key armados pedidos');
            $table->foreign('pedido_armado_id')->references('id')->on('pedido_armados')->onUpdate('restrict')->onDelete('cascade');
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
        Schema::dropIfExists('pedido_armado_tiene_productos');
    }
}
