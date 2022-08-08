<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetodosDeEntregaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metodos_de_entrega', function (Blueprint $table) {
          $table->engine ='InnoDB';
          $table->charset = 'utf8mb4';
          $table->collation = 'utf8mb4_unicode_ci';
          $table->bigIncrements('id');
          $table->string('nom_met_ent',150)->unique()->comment('Nombre del metodo de entrega');
          $table->enum('for_loc', config('opcionesSelect.select_foraneo_local_ambos'))->comment('Foráneo, Local o ambos');
          $table->string('asignado_met_ent', 75)->comment('Correo del usuario al que se le asigno este registro');
          $table->string('created_at_met_ent',75)->nullable()->comment('Correo del usuario que realizo el registro');
          $table->string('updated_at_met_ent',75)->nullable()->comment('Correo del usuario que realizo la última modificación');
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
        Schema::dropIfExists('metodos_de_entrega');
    }
}
