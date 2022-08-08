<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuejasYSugerenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('quejas_y_sugerencias', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->enum('tip', config('opcionesSelect.select_queja_o_sugerencia'))->comment('Tipo');
            $table->enum('depto', config('opcionesSelect.select_departamento'))->comment('Departamento');
            $table->text('obs')->nullable()->comment('Observaciones');
            $table->unsignedBigInteger('user_id')->comment('Foreign Key del código de pago');
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
        Schema::dropIfExists('quejas_y_sugerencias');
    }
}
