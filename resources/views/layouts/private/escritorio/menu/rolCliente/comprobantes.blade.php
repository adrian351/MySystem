<li class="nav-item">
    <a href="{{ route('rolCliente.comprobante.index') }}" class="nav-link {{ Request::is('rc/comprobante*') ? 'active' : '' }}">
      <i class="nav-icon fas fa-file-alt"></i>
      <p>{{ __('Comprobantes') }}</p>
    </a>
  </li>