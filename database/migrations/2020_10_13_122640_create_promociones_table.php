<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromocionesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('promociones', function (Blueprint $table) {
			# ESTA TABLA ES UNA PROPUESTA NO TERMINADA PARA LAS PROMOCIONES DE LOS COSTOS DE ENVIO AL COTIZAR
			$table->engine ='InnoDB';
			$table->charset = 'utf8mb4';
			$table->collation = 'utf8mb4_unicode_ci';
			$table->bigIncrements('id');

			$table->string('mod',150)->comment('Modulo');


			$table->string('met_de_entreg',150)->comment('Método de entrega');
			$table->string('est', 150)->comment('Estado');

			$table->decimal('costo',20,2)->unsigned()->comment('Costo');

			$table->string('asignado_reg', 75)->nullable()->comment('Correo del usuario al qu se le asigno este registro');
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
			Schema::dropIfExists('promociones');
	}
}
