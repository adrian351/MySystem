<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoArmadoProductoTieneSustitutosTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::create('pedido_armado_producto_tiene_sustitutos', function (Blueprint $table) {
          $table->engine ='InnoDB';
          $table->charset = 'utf8mb4';
          $table->collation = 'utf8mb4_unicode_ci';
          $table->bigIncrements('id');
          $table->unsignedBigInteger('id_producto')->comment('id del producto');
          $table->integer('cant')->unsigned()->comment('Cantidad de productos');
          $table->string('produc', 70)->comment('Nombre del producto');
          $table->unsignedBigInteger('producto_id')->comment('Foreign Key');
          $table->foreign('producto_id')->references('id')->on('pedido_armado_tiene_productos')->onUpdate('restrict')->onDelete('cascade');
          $table->string('created_at_sus',75)->comment('Correo del usuario que realizo el registro');
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
      Schema::dropIfExists('pedido_armado_producto_tiene_sustitutos');
  }
}
