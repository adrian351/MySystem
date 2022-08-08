<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosUnificadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos_unificados', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pedido_id')->comment('Foreign Key pedidos');
            $table->unsignedBigInteger('unificado_id')->comment('Foreign Key pedidos');
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('unificado_id')->references('id')->on('pedidos')->onUpdate('restrict')->onDelete('cascade');
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
        Schema::dropIfExists('pedidos_unificados');
    }
}
