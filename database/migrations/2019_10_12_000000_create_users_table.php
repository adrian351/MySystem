<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->string('img_us_rut', 200)->nullable()->comment('Ruta de donde se guardo la imagen');
            $table->string('img_us', 200)->nullable()->comment('Nombre de la imagen');
            $table->enum('acceso', ['1', '2', '3'])->default('2')->comment('Tipo de acceso que tiene (1 = Usuario, 2 = Cliente, 3 = Ferro)');
            $table->enum('registros_tab_acces', ['on'])->nullable()->comment('Define si vera todos los registros de la tabla o solo los que se le asignaron o los que usuario registro (on = todos null = solo sus registros)');
            $table->enum('notif', ['on'])->nullable()->default('on')->comment('Define si recibe o no notificaciones (null = No y on = Si)');
            $table->string('nom', 40)->comment('Nombre');
            $table->string('apell', 40)->comment('Apellido(s)');
            $table->string('email_registro',75)->unique()->comment('Correo con el que se registró al sistema');
            $table->string('email',75)->unique()->comment('Correo con el que tendrá acceso al sistema');
            $table->string('email_secund',75)->nullable()->comment('Correo secundario');
            $table->string('lad_fij', 4)->nullable()->comment('Lada del teléfono fijo');
            $table->string('tel_fij', 15)->nullable()->comment('Teléfono fijo');
            $table->string('ext', 10)->nullable()->comment('Extensión');
            $table->string('lad_mov', 4)->comment('Lada del teléfono móvil');
            $table->string('tel_mov', 15)->comment('Teléfono móvil');
            $table->string('emp', 200)->nullable()->comment('Nombre completo de la empresa a la que pertenece');
            $table->timestamp('email_verified_at')->nullable()->comment('Fecha en la que se verifico el correo');
            $table->dateTime('login')->nullable()->comment('Fecha en la que inicio sesión');
            $table->dateTime('last_login')->nullable()->comment('Fecha de la ultima vez que inicio sesión');
            $table->string('password',120)->default('$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi')->comment('Contraseña');
            $table->rememberToken()->comment('Recordar token del login');
            $table->text('obs')->nullable()->comment('Observaciones');
            $table->enum('lang', ['es', 'en'])->default('es')->comment('Idioma en el que se mostrara el sistema');
            $table->enum('sidebar', ['sidebar-collapse'])->nullable()->comment('Menú del sistema abierto o cerrado');
            $table->enum('col_barr_de_naveg', config('opcionesSelect.select_color_barra_de_navegacion'))->default('navbar-light navbar-white')->comment('Color de la barra superior del sistema');
            $table->enum('col_barr_lat_oscu_o_clar', config('opcionesSelect.select_color_barra_lateral_oscura_o_clara'))->default('sidebar-dark-primary')->comment('Color del menú izquierdo del sistema');
            $table->enum('col_barr_lat_der_oscu_o_clar', config('opcionesSelect.select_color_barra_lateral_derecha_oscura_o_clara'))->default('control-sidebar-light border-left')->comment('Color del menú derecho del sistema');
            $table->enum('col_logot', config('opcionesSelect.select_color_logotipo'))->default('navbar-dark')->comment('Color de la barra donde se encuentra el logotipo del sistema');
            $table->string('asignado_us', 75)->comment('Correo del usuario al qu se le asigno este registro');
            $table->string('created_at_us', 75)->comment('Correo del usuario que realizo el registro');
            $table->string('updated_at_us', 75)->nullable()->comment('Correo del usuario que realizo la última modificación');
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
        Schema::dropIfExists('users');
    }
}
