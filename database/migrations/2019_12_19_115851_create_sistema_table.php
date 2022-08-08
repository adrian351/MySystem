<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSistemaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sistema', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->string('log_neg_rut', 200)->comment('Ruta de donde se guardo el logo color negro');
            $table->string('log_neg', 200)->comment('Nombre del logo color negro');
            $table->string('log_blan_rut', 200)->comment('Ruta de donde se guardo el logo color blanco');
            $table->string('log_blan', 200)->comment('Nombre del logo color blanco');
            $table->string('carrus_login_rut', 200)->comment('Ruta de donde se guardó la imagen que se muestra en el login');
            $table->string('carrus_login', 200)->comment('Nombre de la imagen que se muestra en el login');
            $table->string('carrus_reque_rut', 200)->comment('Ruta de donde se guardó la imagen que se muestra al enviar correo para restablecer la contraseña');
            $table->string('carrus_reque', 200)->comment('Nombre de la imagen que se muestra al enviar correo para restablecer la contraseña');
            $table->string('carrus_rese_rut', 200)->comment('Ruta de donde se guardó la imagen que se muestra al establecer una nueva contraseña');
            $table->string('carrus_rese', 200)->comment('Nombre de la imagen que se muestra al establecer una nueva contraseña');
            $table->string('defau_img_perf_rut', 200)->comment('Ruta de donde se guardó la imagen que se muestra si un usuario no estableció una imagen de perfil');
            $table->string('defau_img_perf', 200)->comment('Nombre de la imagen que se muestra si un usuario no estableció una imagen de perfil');
            $table->string('img_construc_rut', 200)->comment('Ruta de donde se guardó la imagen que se muestra si un módulo está en desarrollo');
            $table->string('img_construc', 200)->comment('Nombre de la imagen que se muestra si un módulo está en desarrollo');
            $table->string('error_rut', 200)->comment('Ruta de donde se guardó la imagen que se muestra algun error en el sistema');
            $table->string('error', 200)->comment('Nombre de la imagen que se muestra si se muestra algun error en el sistema');
            $table->string('emp', 200)->comment('Nombre completo de la empresa');
            $table->string('emp_abrev', 50)->comment('Nombre abreviado de la empresa');
            $table->string('year_de_ini', 15)->comment('Año en el que se inauguró la empresa');
            $table->string('lad_fij', 4)->nullable()->comment('Lada del teléfono fijo');
            $table->string('tel_fij', 15)->nullable()->comment('Teléfono fijo');
            $table->string('ext', 10)->nullable()->comment('Extensión');
            $table->string('lad_mov', 4)->nullable()->comment('Lada del teléfono móvil');
            $table->string('tel_mov', 15)->nullable()->comment('Teléfono móvil');
            $table->string('direc_uno', 500)->comment('Dirección uno de la empresa');
            $table->string('direc_dos', 500)->nullable()->comment('Dirección dos de la empresa');
            $table->string('direc_tres', 500)->nullable()->comment('Dirección tres de la empresa');
            $table->string('corr_vent', 75)->comment('Correo del departamento de ventas');
            $table->string('corr_opc_uno', 75)->nullable()->comment('Correo opción uno');
            $table->string('corr_opc_dos', 75)->nullable()->comment('Correo opción dos');
            $table->string('corr_opc_tres', 75)->nullable()->comment('Correo opción tres');
            $table->string('pag', 100)->nullable()->comment('Pagina web');
            $table->string('red_fbk', 100)->nullable()->comment('URL de la red social facebook');
            $table->string('red_tw', 100)->nullable()->comment('URL de la red social twitter');
            $table->string('red_ins', 100)->nullable()->comment('URL de la red social instagram');
            $table->string('red_link', 100)->nullable()->comment('URL de la red social linkedin');
            $table->string('red_youtube', 100)->nullable()->comment('URL de la red social youtube');
            $table->string('ser_cotizaciones', 20)->nullable()->comment('Value de la serie por default para el módulo Cotizaciones');
            $table->string('ser_pedidos', 20)->nullable()->comment('Value de la serie por default para el módulo Pedidos');
            $table->unsignedBigInteger('plant_usu_bien')->nullable()->comment('Id de la plantilla por default para el módulo Usuarios (Bienvenida)');
            $table->unsignedBigInteger('plant_cli_bien')->nullable()->comment('Id de la plantilla por default para el módulo Clientes (Bienvenida)');
            $table->unsignedBigInteger('plant_per_camb_pass')->nullable()->comment('Id de la plantilla por default para el módulo Perfil (Cambio de contraseña)');
            $table->unsignedBigInteger('plant_sis_rest_pass')->nullable()->comment('Id de la plantilla por default para el módulo Sistema (Restablecimiento de contraseña)');
            $table->unsignedBigInteger('plant_cot_term_cond')->nullable()->comment('Id de la plantilla por default para el módulo Cotizaciones (Términos y condiciones)');
            $table->unsignedBigInteger('plant_vent_reg_ped')->nullable()->comment('Id de la plantilla por default para el módulo Ventas (Registrar pedido)');
            $table->unsignedBigInteger('plant_vent_ped_can')->nullable()->comment('Id de la plantilla por default para el módulo Ventas (Pedido cancelado)');
            $table->unsignedBigInteger('plant_pag_reg_pag')->nullable()->comment('Id de la plantilla por default para el módulo Pagos (Registrar pago)');
            $table->unsignedBigInteger('plant_pag_pag_rech')->nullable()->comment('Id de la plantilla por default para el módulo Pagos (Pago rechazado)');
            $table->unsignedBigInteger('plant_fac_generada')->nullable()->comment('Id de la plantilla por default para el módulo Facturación (Factura generada pago)');
            $table->unsignedBigInteger('plant_fac_cancelado')->nullable()->comment('Id de la plantilla por default para el módulo Facturación (Factura cancelada)');
            $table->unsignedBigInteger('plant_fac_err_cli')->nullable()->comment('Id de la plantilla por default para el módulo Facturación (Error del cliente)');
            $table->unsignedBigInteger('plant_ped_ent')->nullable()->comment('Id de la plantilla por default para el módulo Logística (Pedido entregado)');
            $table->string('created_at_sis', 75)->comment('Correo del usuario que realizo el registro');
            $table->string('updated_at_sis', 75)->nullable()->comment('Correo del usuario que realizo la última modificación');
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
        Schema::dropIfExists('sistema');
    }
}
