@canany(['almacen.producto.index', 'almacen.producto.create', 'almacen.producto.show', 'almacen.producto.edit', 'almacen.producto.disminuirStock', 'almacen.producto.destroy', 'almacen.producto.editValidado', 'almacen.producto.sustituto.create', 'almacen.producto.sustituto.destroy', 'almacen.producto.proveedor.create', 'almacen.producto.proveedor.edit', 'almacen.producto.proveedor.destroy'])
  <li class="nav-item">
    <a href="{{ route('almacen.producto.index') }}" class="nav-link {{ Request::is('almacen/producto') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de productos') }}
    </a>
  </li>
@endcanany
@can('almacen.producto.create')
  <li class="nav-item">
    <a href="{{ route('almacen.producto.create') }}" class="nav-link {{ Request::is('almacen/producto/crear') ? 'active' : '' }}">
      <i class="fas fa-plus-square"></i> {{ __('Registrar producto') }}
    </a>
  </li>
@endcan
 <div class="col-sm-6"></div>
@if (Request::route()->getName() == 'almacen.producto.index')
  @can('almacen.producto.index')
  <li class="nav-item ml-auto ">
    <div class="btn-group dropleft">
      <button type="button" class="btn btn-outline-info btn-md dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ __('Reportes') }}
      </button>
      <div class="dropdown-menu">
        {!! Form::open(['route' => 'almacen.producto.generarReporteDeProducto', 'method' => 'get', 'onsubmit' => 'return checarBotonSubmit("btnsubmit1")']) !!}
          <button type="submit" id="btnsubmit1" class="dropdown-item">{{ __('Reporte de Productos') }}</button>
        {!! Form::close() !!}
            
        {!! Form::open(['route' => 'almacen.producto.generarReporteDeStock', 'method' => 'get', 'onsubmit' => 'return checarBotonSubmit("btnsubmit2")']) !!}
          <button type="submit" id="btnsubmit2" class="dropdown-item">{{ __('Reporte de Acciones-Stocks') }}</button>
        {!! Form::close() !!}

        {!! Form::open(['route' => 'almacen.producto.generarReporteDeSustitutos', 'method' => 'get', 'onsubmit' => 'return checarBotonSubmit("btnsubmit3")']) !!}
          <button type="submit" id="btnsubmit3" class="dropdown-item">
            {{ __('Reporte de Sustitutos') }}
          </button>
        {!! Form::close() !!}

          <button class="dropdown-item" type="button" data-toggle="modal" data-target="#exampleModal">
            {{ __('Reporte de Compra') }}
          </button>
      </div>
    </div>
  {{--  buscar forma de reutilizar un modal | se aplicó solución rápida )--}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        {!! Form::open(['route' => 'almacen.producto.generarReporteDeCompra']) !!}
          <div class="modal-content">
            <div class="modal-header p-2 bg-info">
              <h5 class="title modal-title" id="exampleModalLabel"><b>{{ __('Productos vendidos') }}</b></h5>
              <button type="button" class="close p-0 m-0" data-dismiss="modal" aria-label="Close">
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
              <div id="rango_fechas_pro" >
                <div class="row">
                  <div class="form-group col-sm">
                    <label for="fecha_inicio">{{ __('Desde:') }}</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                      </div>
                      <input type="date" id="fecha_1" name="fecha_1">
                    </div>
                  </div>

                  <div class="form-group col-sm">
                    <label for="fecha_fin">{{ __('Hasta:') }}</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                      </div>
                      <input type="date" id="fecha_2" name="fecha_2">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row" id="a_fecha" style="display: none">
                <div class="form-group col-sm">
                  <label for="fecha_inicio">{{ __('Fecha:') }}</label>
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
              <button type="submit" id="btnsubmit3" class="btn btn-outline-info btn-md">{{ __('Generar reporte') }}</button>
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
  font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.dropdown-item:hover{
  background:rgb(0, 0, 0);
  color:rgb(255, 255, 255);
}


</style>
@endsection

@section('js5')
<script>
  var rangos = document.getElementById('rango_fechas_pro');
  var fecha = document.getElementById('a_fecha');
  var checkbox = document.getElementById('gridCheck');
    checkbox.addEventListener("change", validaCheckbox, false);

  function validaCheckbox(){
    var checked = checkbox.checked;
    if(checked){
      rangos.style.display = 'none';
      fecha.style.display = 'block';
      
      $('#fecha_1').val('');
      $('#fecha_2').val('');
    
    }else if(checked == false){
      rangos.style.display = 'block';
      fecha.style.display = 'none';
      $('#fecha').val('');
    }
  }
</script>
@endsection