<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados', function (Blueprint $table) {
          $table->engine ='InnoDB';
          $table->charset = 'utf8mb4';
          $table->collation = 'utf8mb4_unicode_ci';
          $table->bigIncrements('id');

          $table->string('est',150)->unique()->comment('Estado');
          $table->enum('for_loc', config('opcionesSelect.select_foraneo_local_ambos'))->comment('Foráneo, Local o ambos');

          $table->string('asignado_est', 75)->comment('Correo del usuario al qu se le asigno este registro');
          $table->string('created_at_est',75)->comment('Correo del usuario que realizo el registro');
          $table->string('updated_at_est',75)->nullable()->comment('Correo del usuario que realizo la última modificación');
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
        Schema::dropIfExists('estados');
    }
}
