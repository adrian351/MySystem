<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoArmadoDirecTieneComprobantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_armado_direc_tiene_comprobantes', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');

            $table->string('paq',150)->nullable()->comment('Paquetería (Este es el mismo que Nombre del metodo de entrega especifico)');
            $table->string('num_guia',60)->nullable()->comment('Número de guía');
            $table->string('comp_ent_rut',200)->comment('Ruta comprobate');
            $table->string('comp_ent_nom',200)->comment('Nombre comprobate');

            $table->unsignedBigInteger('direccion_id')->comment('Foreign Key');
            $table->foreign('direccion_id')->references('id')->on('pedido_armado_tiene_direcciones')->onUpdate('restrict')->onDelete('cascade');
            $table->string('created_at_comp', 75)->comment('Correo del usuario que realizo el registro');
            $table->string('updated_at_comp', 75)->nullable()->comment('Correo del usuario que realizo la última modificación');
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
        Schema::dropIfExists('pedido_armado_direc_tiene_comprobantes');
    }
}
