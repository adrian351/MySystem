<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReporteStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reporte_stocks', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');          

            $table->string('reg', 200)->comment('Información a mostrar del registro');
            $table->string('email_usuario', 75)->comment('Correo del usuario que realizo la modificación');
            $table->string('acc', 30)->comment('Acción');
            $table->integer('stock_ant')->nullable()->comment('Stock anterior');
            $table->integer('stock_nuev')->nullable()->comment('Stock nuevo');
            $table->integer('dif')->nullable()->comment('Diferencia');

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
        Schema::dropIfExists('reporte_stocks');
    }
}
