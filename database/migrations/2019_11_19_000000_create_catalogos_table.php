<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogos', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->enum('input', config('opcionesSelect.select_input'))->comment('Nombre del input select');
            $table->string('value', 150)->comment('Valor que se guardara en la BD');
            $table->string('vista', 150)->comment('Valor que se le mostrara al usuario');
            $table->string('asignado_cat', 75)->comment('Correo del usuario al qu se le asigno este registro');
            $table->string('created_at_cat', 75)->comment('Correo del usuario que realizo el registro');
            $table->string('updated_at_cat', 75)->nullable()->comment('Correo del usuario que realizo la última modificación');
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
        Schema::dropIfExists('catalogos');
    }
}
