<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoTieneArchivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_tiene_archivos', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');

            $table->string('nom_visual', 50)->comment('Nombre a mostrar');
            $table->string('arc_rut', 200)->comment('Ruta de donde se guardo el archivo');
            $table->string('arc_nom', 200)->comment('Nombre del archivo');

            $table->unsignedBigInteger('pedido_id')->comment('Foreign Key');
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onUpdate('restrict')->onDelete('cascade');

            $table->string('created_at_reg',75)->nullable()->comment('Correo del usuario que realizo el registro');
            $table->string('updated_at_reg',75)->nullable()->comment('Correo del usuario que realizo la última modificación');
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
        Schema::dropIfExists('pedido_tiene_archivos');
    }
}
