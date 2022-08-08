@canany(['pago.fPedido.index', 'pago.fPedido.create', 'pago.fPedido.show', 'pago.fPedido.edit', 'venta.pedidoActivo.show', 'venta.pedidoActivo.pago.create','venta.pedidoActivo.pago.show', 'venta.pedidoActivo.pago.edit'])
  <li class="nav-item">
    <a href="{{ route('pago.fPedido.index') }}" class="nav-link {{ Request::is('pago/f-pedido') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de pagos (F. por pedido)') }}
    </a>
  </li>
@endcanany
@canany(['pago.index', 'pago.show', 'pago.edit', 'pago.destroy', 'pago.marcarComoFacturado'])
  <li class="nav-item">
    <a href="{{ route('pago.index') }}" class="nav-link {{ Request::is('pago/individual') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de pagos (Individual)') }}
    </a>
  </li>
@endcanany
@if (Request::route()->getName() == 'pago.fPedido.index')
  @can('pago.fPedido.index')
    <li class="nav-item ml-auto">
      {!! Form::open(['route' => 'pago.fPedido.generarReporte', 'method' => 'get']) !!}
        <button type="submit" id="btnsubmit1" class="btn btn-info btn-md"><i class="fas fa-file-excel"></i> {{ __('Reporte F.P') }}</button>
      {!! Form::close() !!}
    </li>
  @endcan
@endif

@if (Request::route()->getName() == 'pago.index')
  {{--  @can('pago.index')
  <li class="nav-item ml-auto">
    {!! Form::open(['route' => 'pago.fPedido.generarReporte', 'method' => 'get']) !!}
      <button type="submit" id="btnsubmit1" class="btn btn-info btn-md"><i class="fas fa-file-excel"></i> {{ __('Reporte P.I') }}</button>
    {!! Form::close() !!}
  </li>
  @endcan  --}}

  @can('pago.index')
    <li class="nav-item ml-auto">
      <button class="btn btn-light btn-md border" type="button" data-toggle="modal" data-target="#exampleModal">
        {{ __('Reporte Pagos Ind.') }}
      </button>

      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          {!! Form::open(['route' => 'pago.generarReporte']) !!}
            <div class="modal-content">
              <div class="modal-header p-2">
                <h5 class="title modal-title" id="exampleModalLabel"><b>{{ __('Pagos Registrados') }}</b></h5>
                <button type="button" class="cerrar close p-0 m-0" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="form-group col-sm">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck">
                      <label class="form-check-label" for="gridCheck">
                        {{ __('Un día en específico')}} </label>
                    </div>
                  </div>
                </div>
                <div id="rango_fechas" >
                  <div class="row">
                    <div class="form-group col-sm">
                      <label for="fecha_inicio">{{ __('Desde: ') }}</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                        <input type="date" id="fecha_inicio" name="fecha_inicio">
                      </div>
                    </div>

                    <div class="form-group col-sm">
                      <label for="fecha_fin">{{ __('Hasta: ') }}</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                        <input type="date" id="fecha_fin" name="fecha_fin">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row" id="a_fecha" style="display: none">
                  <div class="form-group col-sm">
                    <label for="fecha_inicio">{{ __('Fecha: ') }}</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                      </div>
                      <input type="date" id="fecha" name="fecha">
                    </div>
                  </div>
                </div>
                @include('layouts.private.plugins.priv_plu_select2')
              </div>
              <div class="modal-footer p-1">
                <button type="button" class="btn btn-outline-danger btn-md" data-dismiss="modal">{{ __('Cerrar') }}</button>
                <button type="submit" id="btnsubmit3" class="btn btn-outline-info btn-md" onclick="boton()">{{ __('Generar reporte') }}</button>
              </div>
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </li>
  @endcan
@endif

@section('css')
<style>
.title{
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
.modal-header{
  background: rgb(123, 181, 228);
}

</style>
@endsection

@section('js5')
<script>
  var rangos = document.getElementById('rango_fechas');
  var fecha = document.getElementById('a_fecha');
  var checkbox = document.getElementById('gridCheck');
    checkbox.addEventListener("change", validaCheckbox, false);

  function validaCheckbox(){
    var checked = checkbox.checked;

    //var fecha_inicio = document.getElementById('fecha_inicio').value;
    //var fecha_fin = document.getElementById('fecha_fin').value;
    //var valor_fecha = document.getElementById('fecha').value;
    //alert(valor_fecha);
    
    if(checked){
      rangos.style.display = 'none';
      fecha.style.display = 'block';
      
      $('#fecha_inicio').val('');
      $('#fecha_fin').val('');
    
    }else if(checked == false){
      rangos.style.display = 'block';
      fecha.style.display = 'none';
      $('#fecha').val('');
    }
  }
</script>
@endsection

