@canany(['costoDeEnvio.index', 'costoDeEnvio.create', 'costoDeEnvio.show', 'costoDeEnvio.edit', 'costoDeEnvio.destroy'])
  <li class="nav-item">
    <a href="{{ route('costoDeEnvio.index') }}" class="nav-link {{ Request::is('costo-de-envio') ? 'active' : '' }}">
      <i class="fas fa-list nav-icon"></i> {{ __('Lista de costos de envío') }}
    </a>
  </li>
@endcanany
@can('costoDeEnvio.create')
  <li class="nav-item">
    <a href="{{ route('costoDeEnvio.create') }}" class="nav-link {{ Request::is('costo-de-envio/registrar') ? 'active' : '' }}">
      <i class="fas fa-plus-square"></i> {{ __('Registrar costo de envío') }}
    </a>
  </li>
@endcan