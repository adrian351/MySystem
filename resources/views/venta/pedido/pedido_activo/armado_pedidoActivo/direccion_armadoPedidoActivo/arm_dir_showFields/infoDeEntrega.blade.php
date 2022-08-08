<label for="envio_al_que_se_cotizo">{{ __('INFORMACIÓN DE ENTREGA') }}</label>
  <div id="accordion"> 
    <div class="card">
      <div class="card-header" id="headingThree">
        <h5 class="mb-0">
          
          <button class="btn btn-link collapsed p-0" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            <i class="fas fa-map-marker-alt"></i>&nbsp;
            <b>{{ __('VER DIRECCIÓN') }} </b>
            &nbsp;&nbsp;&nbsp;
          </button>
          <span class="float-right">
            {{ __('Estatus pago') }}
            @include('venta.pedido.pedido_activo.ven_pedAct_table.td.estatusPago', ['pedido' => $direccion->armado->pedido])
          </span>
        </h5>
      </div>
      <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
        <div class="card-body">
          @include('rolCliente.direccion.dir_showFields')
        </div>
      </div>
    </div>
  </div>
{{--  <div class="border border-primary rounded p-2">
  
  @include('rolCliente.direccion.dir_showFields')
</div>  --}}