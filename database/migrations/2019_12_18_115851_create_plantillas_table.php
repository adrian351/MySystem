<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantillasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantillas', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->string('nom', 100)->unique()->comment('Nombre de la plantilla que asigna el usuario');
            $table->enum('mod', config('opcionesSelect.select_modulo'))->comment('Modulo al que pertenece la plantilla');
            $table->string('asunt', 100)->comment('Asunto');
            $table->longtext('dis_de_la_plant')->nullable()->comment('Diseño de la plantilla');
            $table->string('asignado_plan', 75)->comment('Correo del usuario al que se le asigno este registro');
            $table->string('created_at_plan', 75)->comment('Correo del usuario que realizo el registro');
            $table->string('updated_at_plan', 75)->nullable()->comment('Correo del usuario que realizo la última modificación');
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
        Schema::dropIfExists('plantillas');
    }
}
