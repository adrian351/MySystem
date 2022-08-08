<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivosGeneradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivos_generados', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->string('tip', 10)->comment('Tipo de archivo');
            $table->text('arch_rut')->comment('Ruta de donde se guardo el archivo');
            $table->text('arch_nom')->comment('Nombre del archivo');
            $table->text('arch_nom_abrev')->comment('Nombre del archivo abreviado');
            $table->unsignedBigInteger('user_id')->comment('Id del usuario que solicita la generación del archivo');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('restrict')->onDelete('cascade');
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
        Schema::dropIfExists('archivos_generados');
    }
}
