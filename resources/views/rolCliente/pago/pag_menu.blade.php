<li class="nav-item">
  <a href="{{ route('rolCliente.pago.index') }}" class="nav-link {{ Request::is('rc/pago') ? 'active' : '' }}">
    <i class="fas fa-list nav-icon"></i> {{ __('Lista de pagos') }}
  </a>
</li>
<li class="nav-item">
  <a href="{{ route('rolCliente.pago.create') }}" class="nav-link {{ Request::is('rc/pago/registrar') ? 'active' : '' }}">
    <i class="fas fa-plus-square"></i> {{ __('Registrar pago') }}
  </a>
</li>