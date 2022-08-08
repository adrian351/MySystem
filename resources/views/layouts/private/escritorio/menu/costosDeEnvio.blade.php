@canany(['costoDeEnvio.index', 'costoDeEnvio.create', 'costoDeEnvio.show', 'costoDeEnvio.edit', 'costoDeEnvio.destroy'])
  <li class="nav-item has-treeview {{ Request::is('costo-de-envio*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is('costo-de-envio*') ? 'active' : '' }}">
      <i class="nav-icon fas fa-shipping-fast"></i>
      <p>
        {{ __('Costos de envío') }}
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      @canany(['costoDeEnvio.index', 'costoDeEnvio.create', 'costoDeEnvio.show', 'costoDeEnvio.edit', 'costoDeEnvio.destroy'])
        <li class="nav-item">
          <a href="{{ route('costoDeEnvio.index') }}" class="nav-link {{ Request::is('costo-de-envio') ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>{{ __('Lista de costos de envío') }}</p>
          </a>
        </li>
      @endcanany
      @can('costoDeEnvio.create')
        <li class="nav-item">
          <a href="{{ route('costoDeEnvio.create') }}" class="nav-link {{ Request::is('costo-de-envio/registrar') ? 'active' : '' }}">
            <i class="nav-icon far fa-plus-square"></i>
            <p>{{ __('Registrar costo de envío') }}</p>
          </a>
        </li>
        @endcan
    </ul>
  </li>
@endcanany