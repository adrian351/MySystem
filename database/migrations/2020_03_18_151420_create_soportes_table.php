<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('soportes', function (Blueprint $table) {
        $table->engine ='InnoDB';
        $table->charset = 'utf8mb4';
        $table->collation = 'utf8mb4_unicode_ci';
        $table->bigIncrements('id');
        $table->string('emp', 100)->comment('Empresa');
        $table->string('sol', 80)->comment('Solicitante');
        $table->string('area_dep', 100)->comment('Área o Departamento');
        $table->string('tec', 80)->nullable()->comment('Técnico');
        $table->string('id_equipo', 25)->nullable()->comment('ID inventario');
        $table->string('grup_de_falla', 150)->nullable()->comment('Agrupación de fallas');
        $table->text('des_de_la_falla')->comment('Descripción de la falla');
        $table->string('tel_fij', 15)->nullable()->comment('Teléfono fijo');
        $table->string('ext', 10)->nullable()->comment('Extensión');
        $table->text('solu')->nullable()->comment('Solución');
        $table->text('obs_del_equipo')->nullable()->comment('Observaciones del equipo');
        $table->string('est', 70)->default('Pendiente')->comment('Estatus del reporte');
        $table->string('update_at_sop', 75)->nullable()->comment('Correo del usuario que realizo la última modificación');
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
        Schema::dropIfExists('soportes');
    }
}
