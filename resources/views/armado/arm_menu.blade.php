@canany(['armado.index', 'armado.create', 'armado.show', 'armado.edit', 'armado.catalogo.select','armado.destroy', 'armado.clon.create', 'armado.producto.create', 'armado.producto.destroy', 'armado.producto.editCantidad'])
  <li class="nav-item">
    <a href="{{ route('armado.index') }}" class="nav-link {{ Request::is('armado') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de armados') }}
    </a>
  </li>
@endcanany
@can('armado.create')
  <li class="nav-item">
    <a href="{{ route('armado.create') }}" class="nav-link {{ Request::is('armado/crear') ? 'active' : '' }}">
      <i class="fas fa-plus-square"></i> {{ __('Registrar armado') }}
    </a>
  </li>
@endcan
@canany(['armado.clon.index', 'armado.clon.create', 'armado.clon.show', 'armado.clon.edit', 'armado.clon.destroy', 'armado.clon.producto.create', 'armado.clon.producto.destroy', 'armado.clon.producto.editCantidad'])
  <li class="nav-item">
    <a href="{{ route('armado.clon.index') }}" class="nav-link {{ Request::is('armado/clon') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de armados clonados') }}
    </a>
  </li>
@endcanany
@canany(['armado.index', 'armado.create', 'armado.show', 'armado.edit', 'armado.catalogo.select','armado.destroy', 'armado.clon.create', 'armado.producto.create', 'armado.producto.destroy', 'armado.producto.editCantidad'])
<li class="nav-item ml-auto">
  {!! Form::open(['route' => 'armado.generarListaDeArmados', 'method' => 'get', 'onsubmit' => 'return checarBotonSubmit("btnsubmitLista")']) !!}
    <button type="submit" id="btnsubmitLista" class="btn btn-outline-info btn-md"><i class="fas fa-file-excel"></i> {{ __('Lista de armados') }}</button>
  {!! Form::close() !!}
</li>
@endcanany
@if(Auth::user()->email == 'desarrolloweb.ewmx@gmail.com')
  @can('armado.index')
    <li class="nav-item ml-auto">
      {!! Form::open(['route' => 'armado.generarCatalogoDeArmados', 'method' => 'get', 'onsubmit' => 'return checarBotonSubmit("btnsubmit1")']) !!}
        <button type="submit" id="btnsubmit1" class="btn btn-info btn-sm"><i class="fas fa-file-pdf"></i> {{ __('Generar catálogo de armados') }}</button>
      {!! Form::close() !!}
    </li>
  @endcan
@endif