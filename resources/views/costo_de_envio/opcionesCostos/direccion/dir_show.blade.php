<h4><label for="redes_sociales">{{ __('INFORMACIÓN') }}</label></h4>
<div class="border border-primary rounded p-3">
  <div class="row">
    @include('cotizacion.armado_cotizacion.cot_arm_show.descripcion')
  </div>
  @include('armado.arm_showFields.medidas')<br>
  <h6><label for="redes_sociales">{{ __('METODO DE ENTREGA SELECCIONADO') }}</label></h6>
  <div class="border border-secondary rounded p-3">
    <div class="row">
      @include('costo_de_envio.cos_showFields.#')
    </div>
    <div class="row">
      @include('costo_de_envio.cos_showFields.cuentaConSeguro')
      @include('costo_de_envio.cos_showFields.tiempoDeEntrega')
    </div>
    <div class="row">
      @include('costo_de_envio.cos_showFields.metodoDeEntrega')
      @include('costo_de_envio.cos_showFields.estado')
      @include('costo_de_envio.cos_showFields.foraneoLocal')
    </div>
    <div class="row">
      @include('costo_de_envio.cos_showFields.tipoDeEnvio')
      @include('costo_de_envio.cos_showFields.costoPorEnvio')
    </div>
  </div> 
</div>