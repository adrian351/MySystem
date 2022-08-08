<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-2 p-1 rounded">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mx-auto">
      @can('cliente.show')
        <li class="nav-item">
          <a href="{{ route('cliente.show.actividad.index', Crypt::encrypt($cliente->id)) }}" class="nav-link {{ Request::is('cliente/detalles/actividad*') ? 'border rounded' : '' }}">
            <i class="fas fa-folder"></i> {{ __('Registro de actividades') }}
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('cliente.show', Crypt::encrypt($cliente->id)) }}" class="nav-link {{ Request::is('cliente/detalles/view*') ? 'border rounded' : '' }}">
            <i class="fas fa-eye"></i> {{ __('Detalles') }}
          </a>
        </li>
      @endcan
      @can('cliente.edit')
        <li class="nav-item">
          <a href="{{ route('cliente.edit', Crypt::encrypt($cliente->id)) }}" class="nav-link {{ Request::is('cliente/editar*') ? 'border rounded' : '' }}">
            <i class="fas fa-edit"></i> {{ __('Editar') }}
          </a>
        </li>
      @endcan
      <li class="nav-item">
        <a href="{{ route('cliente.show.direccion.index', Crypt::encrypt($cliente->id)) }}" class="nav-link {{ Request::is('cliente/detalles/direccion*') ? 'border rounded' : '' }}">
          <i class="fas fa-map-marker-alt"></i> {{ __('Direcciones') }}
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('cliente.show.datoFiscal.index', Crypt::encrypt($cliente->id)) }}" class="nav-link {{ Request::is('cliente/detalles/dato-fiscal*') ? 'border rounded' : '' }}">
          <i class="fas fa-book"></i> {{ __('Datos fiscales') }}
        </a>
      </li>
      @can('cliente.show')
        <li class="nav-item">
          <a href="{{ route('cliente.show.cotizacion.index', Crypt::encrypt($cliente->id)) }}" class="nav-link {{ Request::is('cliente/detalles/cotizacion*') ? 'border rounded' : '' }}">
            <i class="fas fa-folder-minus"></i> {{ __('Cotizaciones') }}
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('cliente.show.pedido.index', Crypt::encrypt($cliente->id)) }}" class="nav-link {{ Request::is('cliente/detalles/pedido*') ? 'border rounded' : '' }}">
            <i class="fas fa-shopping-bag"></i> {{ __('Pedidos') }}
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('cliente.show.factura.index', Crypt::encrypt($cliente->id)) }}" class="nav-link {{ Request::is('cliente/detalles/factura*') ? 'border rounded' : '' }}">
            <i class="fas fa-file-invoice"></i> {{ __('Facturas') }}
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('cliente.show.pago.index', Crypt::encrypt($cliente->id)) }}" class="nav-link {{ Request::is('cliente/detalles/pago*') ? 'border rounded' : '' }}">
            <i class="far fa-money-bill-alt"></i> {{ __('Pagos') }}
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('cliente.show.quejaYSugerencia.index', Crypt::encrypt($cliente->id)) }}" class="nav-link {{ Request::is('cliente/detalles/queja-y-sugerencia*') ? 'border rounded' : '' }}">
            <i class="fas fa-inbox"></i> {{ __('Quejas y sugerencias') }}
          </a>
        </li>
      @endcan
    </ul>
  </div>
</nav>

@section('css')
<style>
  .perfil {
    border-radius: 10px;
    background: linear-gradient(145deg, #f7f7f7, #ffffff);
    box-shadow:  5px 5px 5px #666666,
             -5px -5px 10px #ffffff;
    
  }
</style>
@endsection
