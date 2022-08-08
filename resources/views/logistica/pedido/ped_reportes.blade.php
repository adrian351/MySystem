@if(Request::route()->getName() == 'logistica.pedidoActivo.index')
  @canany(['logistica.pedidoActivo.index'])
    <li class="nav-item ml-auto">
      {!! Form::open(['route' => 'logistica.pedidoActivo.generarReporte', 'method' => 'get']) !!}
        <button type="submit" id="btnsubmitgen1" class="btn btn-info btn-sm"><i class="fas fa-file-excel"></i> {{ __('Generar reporte') }}</button>
      {!! Form::close() !!}
    </li>
  @endcanany
@endif
@if(Request::route()->getName() == 'logistica.direccionLocal.index')
  @canany(['logistica.direccionLocal.index'])
    <li class="nav-item ml-auto">
      {!! Form::open(['route' => 'logistica.direccionLocal.generarReporte', 'method' => 'get']) !!}
        <button type="submit" id="btnsubmitgen2" class="btn btn-info btn-sm"><i class="fas fa-file-excel"></i> {{ __('Generar reporte') }}</button>
      {!! Form::close() !!}
    </li>
  @endcanany
@endif
@if(Request::route()->getName() == 'logistica.direccionForaneo.index')
  @canany(['logistica.direccionForaneo.index'])
    <li class="nav-item ml-auto">
      {!! Form::open(['route' => 'logistica.direccionForaneo.generarReporte', 'method' => 'get']) !!}
        <button type="submit" id="btnsubmitgen3" class="btn btn-info btn-sm"><i class="fas fa-file-excel"></i> {{ __('Generar reporte') }}</button>
      {!! Form::close() !!}
    </li>
  @endcanany
@endif