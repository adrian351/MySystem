{{--  @extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Notificaciones'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('produccion.pedido.ped_menu')
    </ul>
  </div>
  <div class="card-body" >

    {!! Form::model(Request::all(), ['route' => 'produccion.pedido.notificacion.notifi', 'method' => 'GET']) !!}
    @include('global.buscador.buscador', ['num_pag' => 20, 'ruta_recarga' => route('produccion.pedido.notificacion.notifi'), 'opciones_buscador' => config('opcionesSelect.select_sistema_actividad_index')])
    {!! Form::close() !!}
    <div class="notification-container">
      <div class="row shadow-sm py-3">
        <div class="col-4 text-center"><strong>Campo</strong></div>
        <div class="col-6 text-center"><strong>Anterior | Nuevo</strong></div>
      </div>

      <div class="card-body table-responsive p-0" id="div-tabla-scrollbar3" style="height: 40em;"><br/>
        @foreach ($actividad as $act)
        <div class="card">
            <div class="card-body">
              <table>
                <tr>
                  <td width="100%">
                    <div class="card-title col-sm-5">
                      @php
                        $id = (int)$act->reg;
                      @endphp
                      @foreach ($direccion as $dir)
                        @if($dir->id == $id )
                          [{{ $dir->cod }}] 
                        @endif
                      @endforeach
                      @if($act->inpu == 'Comentarios ventas')
                        [{{ $act->reg }}]
                      @endif
                      <b>{{ $act->inpu }} | {{ date('d-m-Y H:i:s', strtotime($act->created_at)) }}</b>
                    </div>
                    <div class="col-sm-11">
                      @if ($act->ant == null )
                        <p><cite><strong>nuevo: </strong> {{ $act->nuev }}</cite></p>
                          @else
                            <p><cite> {{ $act->ant }} <strong>|</strong> {{ $act->nuev }}</cite></p>
                      @endif
                    </div>
                  </td>
                  <td>
                    <a  href="{{ route($act->rut, $act->id_reg) }}" class="btn btn-info " target="_blank" >Ver</a>
                  </td>
                 
                </tr>
              </table>
            </div>
          </div>
        @endforeach
      </div>
    </div>
    @include('global.paginador.paginador', ['paginar' => $actividad])
  </div>
</div>
@endsection  --}}

