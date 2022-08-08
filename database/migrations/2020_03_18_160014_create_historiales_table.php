<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('historiales', function (Blueprint $table) {
        $table->engine ='InnoDB';
        $table->charset = 'utf8mb4';
        $table->collation = 'utf8mb4_unicode_ci';
        $table->bigIncrements('id');
        $table->timestamp('fec_sol_sop')->comment('Fecha en la que se solicito el soporte');
        $table->timestamp('fec_ent')->useCurrent()->comment('Fecha de entrega');
        $table->string('sol', 80)->comment('Nombre del Solicitante');
        $table->string('area_dep', 100)->comment('Area o Departamento');
        $table->string('tec', 80)->comment('Tecnico');
        $table->string('grup_de_falla', 150)->comment('Agrrupacion de fallas');
        $table->text('des_de_la_falla')->comment('Descripcion de la falla');
        $table->text('solu')->comment('Solucion del problema');
        $table->text('obs_del_equipo')->nullable()->comment('observaciones del equipo');
        $table->unsignedBigInteger('inventario_equipo_id')->comment('Llave foranea a Inventario de equipos, id del equipo');
        $table->foreign('inventario_equipo_id')->references('id')->on('inventario_equipos')->onUpdate('cascade')->onDelete('cascade');
        $table->string('created_at_his', 75)->nullable()->comment('Correo del historial que realizo el registro');
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
        Schema::dropIfExists('historiales');
    }
}
