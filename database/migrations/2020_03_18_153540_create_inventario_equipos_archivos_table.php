<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarioEquiposArchivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('inventario_equipos_archivos', function (Blueprint $table) {
        $table->engine ='InnoDB';
        $table->charset = 'utf8mb4';
        $table->collation = 'utf8mb4_unicode_ci';
        $table->bigIncrements('id');
        $table->string('arc_rut', 200)->nullable()->comment('Ruta de donde se guardo el archivo');
        $table->string('arc_nom', 200)->nullable()->comment('Nombre archivo');
        $table->unsignedBigInteger('inventario_equipo_id')->comment('Llave foranea a inventario equipo');
        $table->foreign('inventario_equipo_id')->references('id')->on('inventario_equipos')->onUpdate('restrict')->onDelete('cascade');
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
        Schema::dropIfExists('inventario_equipos_archivos');
    }
}
