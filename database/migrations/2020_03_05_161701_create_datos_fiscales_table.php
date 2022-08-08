<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosFiscalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_fiscales', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
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
            $table->unsignedBigInteger('user_id')->comment('Foreign Key de users');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('restrict')->onDelete('cascade');
            
            $table->string('created_at_dat_fisc',75)->nullable()->comment('Correo del usuario que realizo el registro');
            $table->string('updated_at_dat_fisc',75)->nullable()->comment('Correo del usuario que realizo la última modificación');
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
        Schema::dropIfExists('datos_fiscales');
    }
}
