<li class="nav-item">
  <a href="{{ route('rolCliente.factura.index') }}" class="nav-link {{ Request::is('rc/factura') ? 'active' : '' }}">
    <i class="fas fa-list nav-icon"></i> {{ __('Lista de facturas') }}
  </a>
</li>
<li class="nav-item">
  <a href="{{ route('rolCliente.factura.create') }}" class="nav-link {{ Request::is('rc/factura/solicitar') ? 'active' : '' }}">
    <i class="fas fa-plus-square"></i> {{ __('Solicitar factura') }}
  </a>
</li>