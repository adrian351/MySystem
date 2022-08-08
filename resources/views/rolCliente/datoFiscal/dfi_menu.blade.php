<li class="nav-item">
  <a href="{{ route('rolCliente.datoFiscal.index') }}" class="nav-link {{ Request::is('rc/dato-fiscal') ? 'active' : '' }}">
    <i class="fas fa-list nav-icon"></i> {{ __('Lista de datos fiscales') }}
  </a>
</li>
<li class="nav-item">
  <a href="{{ route('rolCliente.datoFiscal.create') }}" class="nav-link {{ Request::is('rc/dato-fiscal/crear') ? 'active' : '' }}">
    <i class="fas fa-plus-square"></i> {{ __('Registrar datos fiscales') }}
  </a>
</li>