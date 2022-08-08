<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuejasYSugerenciasArchivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quejas_y_sugerencias_archivos', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->string('arch_rut', 200)->nullable()->comment('Ruta de donde se guardo el archivo');
            $table->string('arch_nom', 200)->nullable()->comment('Nombre del archivo');
            $table->unsignedBigInteger('queja_y_sugerencia_id')->comment('Foreign Key del código de pago');
            $table->foreign('queja_y_sugerencia_id')->references('id')->on('quejas_y_sugerencias')->onUpdate('restrict')->onDelete('cascade');
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
        Schema::dropIfExists('quejas_y_sugerencias_archivos');
    }
}
