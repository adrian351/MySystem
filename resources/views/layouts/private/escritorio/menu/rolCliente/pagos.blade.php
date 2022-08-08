<li class="nav-item has-treeview {{ Request::is('rc/pago*') ? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ Request::is('rc/pago*') ? 'active' : '' }}">
    <i class="nav-icon far fa-money-bill-alt"></i>
    <p>
      {{ __('Pagos') }}
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ route('rolCliente.pago.index') }}" class="nav-link {{ Request::is('rc/pago') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list"></i>
        <p>{{ __('Lista de pagos') }}</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('rolCliente.pago.create') }}" class="nav-link {{ Request::is('rc/pago/registrar') ? 'active' : '' }}">
        <i class="nav-icon far fa-plus-square"></i>
        <p>{{ __('Registrar pago') }}</p>
      </a>
    </li>
  </ul>
</li>