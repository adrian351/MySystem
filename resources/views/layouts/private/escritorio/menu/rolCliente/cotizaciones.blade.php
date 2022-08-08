<li class="nav-item">
  <a href="{{ route('rolCliente.cotizacion.index') }}" class="nav-link {{ Request::is('rc/cotizacion*') ? 'active' : '' }}">
    <i class="nav-icon fas fa-folder-minus"></i>
    <p>{{ __('Cotizaciones') }}</p>
  </a>
</li>