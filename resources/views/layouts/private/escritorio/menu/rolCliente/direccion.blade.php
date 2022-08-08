<li class="nav-item has-treeview {{ Request::is('rc/direccion*') ? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ Request::is('rc/direccion*') ? 'active' : '' }}">
    <i class="nav-icon fas fa-map-marker-alt"></i>
    <p>
      {{ __('Direcciones de entrega') }}
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ route('rolCliente.direccion.index') }}" class="nav-link {{ Request::is('rc/direccion-de-entrega') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list"></i>
        <p>{{ __('Lista de direcciones') }}</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('rolCliente.direccion.create') }}" class="nav-link {{ Request::is('rc/direccion-de-entrega/registrar') ? 'active' : '' }}">
        <i class="nav-icon far fa-plus-square"></i>
        <p>{{ __('Registrar dirección') }}</p>
      </a>
    </li>
  </ul>
</li>