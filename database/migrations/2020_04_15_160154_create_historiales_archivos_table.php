<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialesArchivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('historiales_archivos', function (Blueprint $table) {
        $table->engine ='InnoDB';
        $table->charset = 'utf8mb4';
        $table->collation = 'utf8mb4_unicode_ci';
        $table->bigIncrements('id');
        $table->string('his_arch_rut', 200)->nullable()->comment('Ruta de donde se guardo el historial del archivo');
        $table->string('his_arch', 200)->nullable()->comment('Nombre del historial del archivo');
        $table->unsignedBigInteger('historial_id')->comment('Llave foranea a historiales');
        $table->foreign('historial_id')->references('id')->on('historiales')->onUpdate('restrict')->onDelete('cascade');
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
        Schema::dropIfExists('historiales_archivos');
    }
}
