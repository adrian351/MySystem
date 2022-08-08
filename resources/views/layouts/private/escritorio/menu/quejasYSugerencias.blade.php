@canany(['qys.index', 'qys.create', 'qys.show'])
  <li class="nav-item has-treeview {{ Request::is('qys*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is('qys*') ? 'active' : '' }}">
      <i class="nav-icon fas fa-inbox"></i>
      <p>
        {{ __('Quejas y sugerencias') }}
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      @canany(['qys.index', 'qys.show'])
        <li class="nav-item">
          <a href="{{ route('qys.index') }}" class="nav-link {{ Request::is('qys') ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>{{ __('Lista de quejas y sugerencias') }}</p>
          </a>
        </li>
      @endcanany
      @can('qys.create')
        <li class="nav-item">
          <a href="{{ route('qys.create') }}" class="nav-link {{ Request::is('qys/registrar') ? 'active' : '' }}">
            <i class="nav-icon far fa-plus-square"></i>
            <p>{{ __('Registrar') }}</p>
          </a>
        </li>
      @endcan
    </ul>
  </li>
@endcanany