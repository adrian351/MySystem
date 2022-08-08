@canany(['etiqueta.index', 'etiqueta.create', 'etiqueta.show', 'etiqueta.edit', 'etiqueta.destroy'])
  <li class="nav-item has-treeview {{ Request::is('etiqueta*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is('etiqueta*') ? 'active' : '' }}">
      <i class="nav-icon fas fa-tags"></i>
      <p>
        {{ __('Etiquetas') }}
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      @canany(['etiqueta.index', 'etiqueta.create','etiqueta.show','etiqueta.edit', 'etiqueta.destroy'])
        <li class="nav-item">
          <a href="{{  route('etiqueta.index') }}" class="nav-link {{ Request::is('etiqueta') ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>{{ __('Lista de etiquetas') }}</p>
          </a>
        </li>
      @endcanany
      @can('etiqueta.create')
        <li class="nav-item">
          <a href="{{ route('etiqueta.create') }}" class="nav-link {{ Request::is('etiqueta/crear') ? 'active' : '' }}">
            <i class="nav-icon far fa-plus-square"></i>
            <p>{{ __('Registrar etiqueta') }}</p>
          </a>
        </li>
        @endcan
    </ul>
  </li>
@endcanany