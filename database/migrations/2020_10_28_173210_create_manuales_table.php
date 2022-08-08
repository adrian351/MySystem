<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManualesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manuales', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->enum('usu_cli_ambos', config('opcionesSelect.select_usu_cli_ambos'))->comment('Usuario, cliente o ambos');
            $table->string('valor', 150)->unique()->comment('Valor que se guardara en la BD');
            $table->string('rut', 200)->comment('Ruta de donde se guardo');
            $table->string('nom', 200)->comment('Nombre del archivo');
            $table->string('rut_edit', 200)->comment('Ruta de donde se guardo el archivo editable');
            $table->string('nom_edit', 200)->comment('Nombre del archivo editable');
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
        Schema::dropIfExists('manuales');
    }
}
