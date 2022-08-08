<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->date('fech_facturado')->nullable()->comment('Fecha en la que se facturo');
            $table->string('est_fact',100)->default(config('app.pendiente'))->comment('Estatus factura');
            $table->string('nom_o_raz_soc',60)->comment('Nombre o razón social');
            $table->string('rfc',20)->comment('RFC');
            $table->string('lad_fij',4)->nullable()->comment('Lada del teléfono fijo');
            $table->string('tel_fij',15)->nullable()->comment('Teléfono fijo');
            $table->string('ext',10)->nullable()->comment('Extensión');
            $table->string('lad_mov',4)->comment('Lada del teléfono móvil');
            $table->string('tel_mov',15)->comment('Teléfono móvil');
            $table->string('calle',45)->comment('Calle');
            $table->string('no_ext',8)->comment('Número exterior');
            $table->string('no_int',30)->nullable()->comment('Número interior');
            $table->string('pais',40)->comment('País');
            $table->string('ciudad',50)->comment('Ciudad');
            $table->string('col',40)->comment('Colonia');
            $table->string('del_o_munic',50)->comment('Delegación o Municipio');
            $table->string('cod_post',6)->comment('Código Postal');
            $table->string('corr',75)->comment('Correo');

            $table->enum('uso_de_cfdi',config('opcionesSelect.select_uso_de_cfdi'))->comment('Uso de CFDI');
            $table->enum('met_de_pag', config('opcionesSelect.select_metodo_de_pago'))->comment('Método de pago');
            $table->enum('form_de_pag', config('opcionesSelect.select_forma_de_pago_factura'))->comment('Forma de pago');
            $table->string('banc_de_cuent_de_retir',50)->nullable()->comment('Banco de cuenta de retiro');
            $table->string('ulti_cuatro_dig_cuent_de_retir',4)->nullable()->comment('Últimos cuatro dígitos de la cuenta de retiro');
        //    $table->decimal('mont_a_fact',20, 2)->unsigned()->comment('Monto a facturar');

            $table->enum('concept', config('opcionesSelect.select_concepto'))->comment('Concepto');
            $table->text('coment_u_obs_us')->nullable()->comment('Comentarios u Observaciones del usuario');
            $table->text('coment_admin')->nullable()->comment('Comentarios del administrador');
           
            $table->string('fact_pdf_rut',200)->nullable()->comment('Ruta de la factura PDF');
            $table->string('fact_pdf_nom',200)->nullable()->comment('Nombre de la factura PDF');
            $table->string('fact_xlm_rut',200)->nullable()->comment('Ruta de la factura XLM');
            $table->string('fact_xlm_nom',200)->nullable()->comment('Nombre de la factura XLM');
            $table->string('ppd_pdf_rut',200)->nullable()->comment('Ruta de Pago en Parcialidades o Diferido PDF');
            $table->string('ppd_pdf_nom',200)->nullable()->comment('Nombre de Pago en Parcialidades o Diferido PDF');
            $table->string('ppd_xlm_rut',200)->nullable()->comment('Ruta de Pago en Parcialidades o Diferido XLM');
            $table->string('ppd_xlm_nom',200)->nullable()->comment('Nombre de Pago en Parcialidades o Diferido XLM');

            $table->unsignedBigInteger('pago_id')->comment('Foreign Key del código de pago');
            $table->foreign('pago_id')->references('id')->on('pagos')->onUpdate('restrict')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->comment('Foreign Key del código de pago');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('restrict')->onDelete('cascade');
            $table->string('created_at_fact',75)->comment('Correo del usuario que realizo el registro');
            $table->string('updated_at_fact',75)->nullable()->comment('Correo del usuario que realizo la última modificación');
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
        Schema::dropIfExists('facturas');
    }
}
