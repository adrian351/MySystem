<li class="nav-item">
  <a href="{{ route('rolCliente.direccion.index') }}" class="nav-link {{ Request::is('rc/direccion-de-entrega') ? 'active' : '' }}">
    <i class="fas fa-list nav-icon"></i> {{ __('Lista de direcciones') }}
  </a>
</li>
<li class="nav-item">
  <a href="{{ route('rolCliente.direccion.create') }}" class="nav-link {{ Request::is('rc/direccion-de-entrega/crear') ? 'active' : '' }}">
    <i class="fas fa-plus-square"></i> {{ __('Registrar dirección') }}
  </a>
</li>