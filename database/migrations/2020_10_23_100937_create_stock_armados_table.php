<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockArmadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_armados', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');

            $table->unsignedBigInteger('armado_id')->comment('Foreign Key armados');
            $table->unsignedBigInteger('stock_id')->comment('Foreign Key');
            $table->foreign('armado_id')->references('id')->on('armados')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('stock_id')->references('id')->on('stocks')->onUpdate('restrict')->onDelete('cascade');

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
        Schema::dropIfExists('stock_armados');
    }
}
