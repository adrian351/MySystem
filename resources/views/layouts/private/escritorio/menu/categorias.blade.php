@canany(['categoria.index', 'categoria.create', 'categoria.edit', 'categoria.destroy'])
  <li class="nav-item has-treeview {{ Request::is('categoria*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is('categoria*') ? 'active' : '' }}">
      <i class="nav-icon fas fa-dice-five"></i>
      <p>
        {{ __('Categorias') }}
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      @canany(['categoria.index', 'categoria.create','categoria.edit', 'categoria.destroy'])
        <li class="nav-item">
          <a href="{{  route('categoria.index') }}" class="nav-link {{ Request::is('categoria') ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>{{ __('Lista de categorias') }}</p>
          </a>
        </li>
      @endcanany
      @can('categoria.create')
        <li class="nav-item">
          <a href="{{ route('categoria.create') }}" class="nav-link {{ Request::is('categoria/crear') ? 'active' : '' }}">
            <i class="nav-icon far fa-plus-square"></i>
            <p>{{ __('Registrar categoria') }}</p>
          </a>
        </li>
        @endcan
    </ul>
  </li>
@endcanany