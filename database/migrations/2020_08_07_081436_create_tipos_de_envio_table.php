<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposDeEnvioTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
      Schema::create('tipos_de_envio', function (Blueprint $table) {
        $table->engine ='InnoDB';
        $table->charset = 'utf8mb4';
        $table->collation = 'utf8mb4_unicode_ci';
        $table->bigIncrements('id');
        $table->string('tip_de_env',80)->comment('Tipo de envio');
        $table->unsignedBigInteger('metodo_de_entrega_id')->comment('Foreign Key');
        $table->foreign('metodo_de_entrega_id')->references('id')->on('metodos_de_entrega')->onUpdate('restrict')->onDelete('cascade');
        $table->string('created_at_tip',75)->nullable()->comment('Correo del usuario que realizo el registro');
        $table->string('updated_at_tip',75)->nullable()->comment('Correo del usuario que realizo la última modificación');
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
        Schema::dropIfExists('tipos_de_envio');
    }
}
