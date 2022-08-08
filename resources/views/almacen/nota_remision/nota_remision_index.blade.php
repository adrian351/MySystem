@extends('layouts.private.escritorio.dashboard') 
@section('contenido')
<title>@section('title', __('Lista de notas de remisión'))</title>
<div class="card">
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'almacen.nota.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('almacen.nota.index'), 'opciones_buscador' => config('opcionesSelect.select_nota_remision_index')])
    {!! Form::close() !!}
    <div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
    <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
        @if(sizeof($notas) == 0)
          @include('layouts.private.busquedaSinResultados')
        @else 
          <thead>
            <tr> 
              <th>{{ __('ID') }}</th>
              <th>{{ __('PRODUCTO') }}</th>
              <th>{{ __('ESTATUS') }}</th>
              <th>{{ __('CANT_ENVIADA') }}</th>
              <th>{{ __('ALM_SALIDA') }}</th>
              <th>{{ __('ALM_ENTRADA') }}</th>
              <th>{{ __('P_APROBÓ') }}</th>
              <th>{{ __('P_TRASLADÓ') }}</th>
              <th>{{ __('P_RECIBIÓ') }}</th>
              <th>{{ __('CANT_RECIBÍDA') }}</th>
              {{--  <th>{{ __('PRO_ID') }}</th>  --}}
              <th>{{ __('FECHA_EMISIÓN') }}</th>
              <th colspan="3">&nbsp</th>
            </tr>
          </thead>
          <tbody> 
            @foreach($notas as $nota)
                <tr>
                <td>{{ $nota->id }}</td>
                <td>{{ $nota->product }}</td>
                <td>
                  @if ($nota->estat == config('app.sin_confirmar'))
                    <span class="badge" style="background:{{ config('app.color_q') }};color:{{ config('app.color_0') }};">{{ $nota->estat }}</span>
                    @elseif ($nota->estat == config('app.falta_producto'))
                      <span class="badge" style="background:{{ config('app.color_e') }};color:{{ config('app.color_0') }};">{{ $nota->estat }}</span>
                      @else
                      <span class="badge" style="background:{{ config('app.color_p') }};color:{{ config('app.color_0') }};">{{ $nota->estat }}</span>
                  @endif
                </td>
                <td>{{ $nota->cant_envio }}</td>
                <td>{{ $nota->alm_sal }}</td>
                <td>{{ $nota->alm_ent }}</td>
                <td>{{ $nota->per_aprueba }}</td>
                <td>{{ $nota->per_lleva }}</td>
                <td>{{ $nota->per_recibe }}</td>
                <td>{{ $nota->cant_recibida > 0 ? $nota->cant_recibida : 0 }}</td>
                <td>{{ date('d-m-Y', strtotime($nota->created_at)) }}</td>
      
                <td width="1rem">
                    @can('almacen.nota.descargar')
                        <a href="{{ route('almacen.nota.generarNotaRemision', Crypt::encrypt($nota->id)) }}" id="nota_remision" data-toggle="tooltip" data-placement="bottom" class='btn btn-outline-primary btn-sm'  title="Descargar nota de remisión" download><i class="fas fa-download"></i></a>
                    @endcan
                </td>
                <td width="1rem">
                  @can('almacen.nota.index', 'almacen.nota.generar')
                    <a href="{{ route('almacen.nota.generarNotaRemision', Crypt::encrypt($nota->id)) }}" id="nota_remision" data-toggle="tooltip" data-placement="bottom" class='btn btn-outline-danger btn-sm' target="_blank"  title="Generar nota de remisión" ><i class="fas fa-file-pdf"></i></a>
                  @endcan
                </td>
                <td width="1rem" title="Confirmar: {{ $nota->id }}">
                  @can('almacen.nota.edit')
                    @if ($nota->estat != config('app.confirmada'))
                      <a href="{{ route('almacen.nota.edit', Crypt::encrypt($nota->id)) }}" class='confirmar btn btn-outline-info btn-sm'>{{ __('Confirmar') }}</a>
                    @endif
                  @endcan
                </td>
                </tr>
            @endforeach
          </tbody>
        @endif
      </table>
    </div>
    @include('global.paginador.paginador', ['paginar' => $notas])
  </div>
</div>
@endsection

@section('css')
<style>
  .confirmar{
    border-radius:20px;
  }

</style>
  
@endsection
