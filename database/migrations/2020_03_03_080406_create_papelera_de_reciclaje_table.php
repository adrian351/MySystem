<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePapeleraDeReciclajeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('papelera_de_reciclaje', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->string('mod', 50)->comment('Nombre del módulo en el que se elimino el registro');
            $table->string('reg', 200)->comment('Información a mostrar en la papelera');
            $table->string('tab', 50)->comment('Nombre de la tabla en la BD');
            $table->string('id_reg', 20)->comment('ID de registro eliminado');
            $table->string('id_fk', 20)->nullable()->comment('ID de la llave foranea con la que tiene relación');
            $table->string('deleted_at_reg', 75)->comment('Correo del usuario que realizo el registro');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('papelera_de_reciclaje');
    }
}
