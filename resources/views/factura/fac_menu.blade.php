@canany(['factura.index', 'factura.create', 'factura.show', 'factura.edit', 'factura.destroy'])
  <li class="nav-item">
    <a href="{{ route('factura.index') }}" class="nav-link {{ Request::is('factura') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de facturas') }}
    </a>
  </li>
@endcanany
@can('factura.create')
  <li class="nav-item">
    <a href="{{ route('factura.create') }}" class="nav-link {{ Request::is('factura/solicitar') ? 'active' : '' }}">
      <i class="fas fa-plus-square"></i> {{ __('Solicitar factura') }}
    </a>
  </li>
@endcan
@canany(['factura.index'])
<li class="nav-item ml-auto">
  {!! Form::open(['route' => 'factura.generarReporte', 'method' => 'get']) !!}
    <div class="input-group input-group-sm">
      {!! Form::date('fecha', date('Y-m-d'), ['class' => 'form-control']) !!}
      <button type="submit" id="btnsubmitgen3" class="btn btn-info btn-sm my-2 my-sm-0 ml-3"><i class="fas fa-file-excel"></i> {{ __('Generar reporte') }}</button>
    </div>
  {!! Form::close() !!}
</li>
@endcanany