<li class="nav-item has-treeview {{ Request::is('rc/factura*') ? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ Request::is('rc/factura*') ? 'active' : '' }}">
    <i class="nav-icon fas fa-file-invoice"></i>
    <p>
      {{ __('Facturas') }}
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ route('rolCliente.factura.index') }}" class="nav-link {{ Request::is('rc/factura') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list"></i>
        <p>{{ __('Lista de facturas') }}</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('rolCliente.factura.create') }}" class="nav-link {{ Request::is('rc/facturas/solicitar') ? 'active' : '' }}">
        <i class="nav-icon far fa-plus-square"></i>
        <p>{{ __('Solicitar factura') }}</p>
      </a>
    </li>
  </ul>
</li>