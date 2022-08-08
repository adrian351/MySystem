@canany(['subCategoria.index', 'subCategoria.create', 'subCategoria.edit', 'subCategoria.destroy'])
  <li class="nav-item has-treeview {{ Request::is('subCategoria*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is('subCategoria*') ? 'active' : '' }}">
      <i class="nav-icon fas fa-dice"></i>
      <p>
        {{ __('SubCategorias') }}
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      @canany(['subCategoria.index', 'subCategoria.create','subCategoria.edit', 'subCategoria.destroy'])
        <li class="nav-item">
          <a href="{{ route('subCategoria.index') }}" class="nav-link {{ Request::is('subCategoria') ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>{{ __('Lista de SubCategorias') }}</p>
          </a>
        </li>
      @endcanany
      @can('subCategoria.create')
        <li class="nav-item">
          <a href="{{ route('subCategoria.create') }}" class="nav-link {{ Request::is('subCategoria/crear') ? 'active' : '' }}">
            <i class="nav-icon far fa-plus-square"></i>
            <p>{{ __('Registrar SubCategoria') }}</p>
          </a>
        </li>
        @endcan
    </ul>
  </li>
@endcanany