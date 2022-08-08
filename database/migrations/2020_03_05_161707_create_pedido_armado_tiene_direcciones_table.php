<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoArmadoTieneDireccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_armado_tiene_direcciones', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->string('cod',60)->comment('Código');
            
            
            $table->string('rut',50)->nullable()->comment('Ruta asignada');

            $table->string('regresado',10)->default('Falso')->comment('Opción para bloquear el editar las direcciones si el armado se refresa de logística a producción (falso o verdadero)');  
            $table->integer('cant')->unsigned()->comment('Cantidad');
            $table->string('estat',70)->default('Pendiente')->comment('Estatus');
            $table->string('tip_tarj_felic',30)->default('Estandar')->comment('Tipo de tarjeta de felicitación');
            $table->text('mens_dedic')->nullable()->comment('Mensaje dedicatoria');
            $table->string('tarj_dise_rut',200)->nullable()->comment('Ruta tarjeta diseñada');
            $table->string('tarj_dise_nom',200)->nullable()->comment('Nombre tarjeta diseñada');
            $table->string('met_de_entreg', 150)->comment('Método de entrega de ventas');
            $table->timestamp('fech_en_alm_salida')->nullable()->comment('Fecha en la que la direccion cambio a almacén de salida');
            $table->string('est',150)->comment('Estado a la que se cotizó');
            $table->enum('for_loc', config('opcionesSelect.select_foraneo_local'))->comment('Foráneo o Local');
            $table->text('detalles_de_la_ubicacion')->comment('Detalles de la ubicación');
            $table->string('tip_env', 80)->nullable()->comment('Tipo de envío');
            $table->decimal('cost_por_env',20,2)->unsigned()->nullable()->comment('Costo por envío venta');


            $table->string('caj', 80)->nullable()->comment('Cuenta o no con caja y tamaño');

            $table->string('created_com_sal',75)->nullable()->comment('Correo del usuario que subio el comprobante de salida');
            $table->timestamp('fech_car_comp_de_sal')->nullable()->comment('Fecha en que que subio el comprobante de salida');
            $table->string('met_de_entreg_de_log',150)->nullable()->comment('Método de entrega de logística');
            $table->string('met_de_entreg_de_log_esp',150)->nullable()->comment('Método de entrega especifico de logística');
            $table->string('comp_de_sal_rut', 200)->nullable()->comment('Ruta de donde se guardo el comprobante de salida');
            $table->string('comp_de_sal_nom', 200)->nullable()->comment('Nombre del comprobante de salida');
            $table->string('url',200)->nullable()->comment('URL rastreo');
            $table->decimal('cost_por_env_log',20,2)->nullable()->comment('Costo por envío logística');
            $table->string('nom_ref_uno',80)->nullable()->comment('Nombre referencia uno');
            $table->string('nom_ref_dos',80)->nullable()->comment('Nombre referencia dos');
            $table->string('lad_fij',4)->nullable()->comment('Lada del teléfono fijo');
            $table->string('tel_fij',15)->nullable()->comment('Teléfono fijo');
            $table->string('ext',10)->nullable()->comment('Extensión');
            $table->string('lad_mov',4)->nullable()->comment('Lada del teléfono móvil');
            $table->string('tel_mov',15)->nullable()->comment('Teléfono móvil');
            $table->string('calle',45)->nullable()->comment('Calle');
            $table->string('no_ext',8)->nullable()->comment('Número exterior');
            $table->string('no_int',30)->nullable()->comment('Número interior');
            $table->string('pais',40)->nullable()->comment('País');
            $table->string('ciudad',50)->nullable()->comment('Ciudad');
            $table->string('col',40)->nullable()->comment('Colonia');
            $table->string('del_o_munic',50)->nullable()->comment('Delegación o Municipio');
            $table->string('cod_post',6)->nullable()->comment('Código Postal');
            $table->text('ref_zon_de_entreg')->nullable()->comment('Referencia zona de entrega');
           
            $table->unsignedBigInteger('pedido_armado_id')->comment('Foreign Key armados pedidos');
            $table->foreign('pedido_armado_id')->references('id')->on('pedido_armados')->onUpdate('restrict')->onDelete('cascade');
            $table->string('created_at_direc_arm',75)->comment('Correo del usuario que realizo el registro');
            $table->string('updated_at_direc_arm',75)->nullable()->comment('Correo del usuario que realizo la última modificación');
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
        Schema::dropIfExists('pedido_armado_tiene_direcciones');
    }
}
