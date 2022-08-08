<div class="card alert" style="background: #eff78a">
  <div class="card-body p-1">
    <li>
      {{ __('Favor de asignar la dirección específica y la persona encargada de recibir el pedido en las diferentes direcciones.') }}
    </li>
    <li>
      <b>
        {{ __('Si su(s) armado(s) va(n) a diferentes direcciones, comuníquese con soporte (ext. 1300) para poder dividir las cantidades. Sólo menores a 20 direcciones diferentes.') }}
      </b>
    </li>
  </div>
</div>

<div class="card {{ config('app.color_card_secundario') }}">
  <div class="card-header p-1 {{ config('app.color_bg_secundario') }}">
    <h5>{{ __('Direcciones') }}</h5> 
  </div>
  <div class="card-body">
    @if(Request::route()->getName() == 'rolCliente.pedido.edit')
      @include('rolCliente.pedido.armado.direccion.dir_table')
    @else
    @include('rolCliente.pedido.armado.direccion.dir_tableShow')

    @endif
  </div>
</div>