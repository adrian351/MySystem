<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreciosPorYearTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('precios_por_year', function (Blueprint $table) {
      $table->engine ='InnoDB';
      $table->charset = 'utf8mb4';
      $table->collation = 'utf8mb4_unicode_ci';
      $table->bigIncrements('id');
      $table->string('year', 130)->comment('Año');
      $table->decimal('prec', 20,2)->unsigned()->comment('Precio');
      $table->unsignedBigInteger('producto_id')->comment('Foreign Key productos');
      $table->foreign('producto_id')->references('id')->on('productos')->onUpdate('restrict')->onDelete('cascade');
      $table->string('created_at_pre', 75)->nullable()->comment('correo del usuario que realizo el registro');
      $table->string('updated_at_pre', 75)->nullable()->comment('correo del usuario que realizo la última modificacion');
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
    Schema::dropIfExists('precios_por_year');
  }
}
