<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarioEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('inventario_equipos', function (Blueprint $table) {
        $table->engine ='InnoDB';
        $table->charset = 'utf8mb4';
        $table->collation = 'utf8mb4_unicode_ci';
        $table->bigIncrements('id');
        $table->string('id_equipo', 25)->unique()->comment('ID inventario');
        $table->date('ult_fec_de_man')->nullable()->comment('Ultima fecha de mantenimiento');
        $table->date('prox_fec_de_man')->nullable()->comment('Proxima fecha de mantenimiento');
        $table->string('emp', 100)->comment('Empresa');
        $table->string('resp', 80)->comment('Responsable');
        $table->text('des_del_equ')->nullable()->comment('Descripción del equipo');
        $table->text('obs')->nullable()->comment('observaciones');
        $table->string('num_ser', 40)->comment('Numero de serie');
        $table->string('mar', 50)->comment('Marca del equipo');
        $table->string('mod', 50)->comment('Modelo del equipo');
        $table->string('asignado_inv_equ', 75)->comment('Correo del usuario al que se le asigno este registro');
        $table->string('created_at_inv_equ', 75)->comment('Correo del usuario que realizo el registro');
        $table->string('updated_at_inv_equ', 75)->nullable()->comment('Correo del usuario que realizo la ultima modificacion');
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
        Schema::dropIfExists('inventario_equipos');
    }
}
