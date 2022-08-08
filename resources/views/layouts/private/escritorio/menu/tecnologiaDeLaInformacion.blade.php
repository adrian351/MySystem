@canany(['soporte.index', 'soporte.show', 'soporte.edit', 'soporte.destroy', 'inventario.index', 'inventario.create', 'inventario.show', 'inventario.edit', 'inventario.destroy'])
<li class="nav-item has-treeview {{ Request::is('ti*') ? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ Request::is('ti*') ? 'active' : '' }}">
    <i class="nav-icon fas fa-desktop"></i>
    <p>
      {{ __('Tecnologías de la información') }}
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ route('ti.index') }}" class="nav-link {{ Request::is('inicio-ti') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>{{ __('Inicio TI') }}</p>
      </a>
    </li>
    @canany(['soporte.index', 'soporte.show', 'soporte.edit', 'soporte.destroy'])
    <li class="nav-item">
      <a href="{{ route('soporte.index') }}" class="nav-link {{ Request::is('ti/soporte*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list"></i>
        <p>{{ __('Lista de soportes') }}</p>
      </a>
    </li>
    @endcanany
    @canany(['inventario.edit', 'inventario.index', 'inventario.create', 'inventario.show', 'inventario.destroy'])
      <li class="nav-item has-treeview {{ Request::is('ti/inventario*') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ Request::is('ti/inventario*') ? 'active' : '' }}">
          <i class="nav-icon fas fa-dolly-flatbed"></i>
          <p>
            {{ __('Inventario') }}
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          @canany(['inventario.edit', 'inventario.index', 'inventario.create', 'inventario.show', 'inventario.destroy'])
            <li class="nav-item">
              <a href="{{ route('inventario.index') }}" class="nav-link {{ Request::is('ti/inventario') ? 'active' : '' }}">
                <i class="nav-icon fas fa-list"></i>
                <p>{{ __('Lista de inventario') }}</p>
              </a>
            </li>
          @endcanany
          @can('inventario.create')
            <li class="nav-item">
              <a href="{{ route('inventario.create')}}" class="nav-link {{ Request::is('ti/inventario/crear') ? 'active' : '' }}">
                <i class="nav-icon far fa-plus-square"></i>
                <p>{{ __('Registrar inventario') }}</p>
              </a>
            </li>
          @endcan
        </ul>
      </li>
    @endcanany          
  </ul>
</li>
@endcanany