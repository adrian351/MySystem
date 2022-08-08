<li class="nav-item has-treeview {{ Request::is('f/ruta*') ? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ Request::is('f/ruta*') ? 'active' : '' }}">
    <i class="nav-icon fas fa-road"></i>
    <p>
      {{ __('Rutas') }}
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ route('rolFerro.ruta.index') }}" class="nav-link {{ Request::is('f/ruta') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list"></i>
        <p>{{ __('Lista de rutas') }}</p>
      </a>
    </li>  
    <li class="nav-item">
      <a href="{{ route('rolFerro.ruta.create') }}" class="nav-link {{ Request::is('f/ruta/crear') ? 'active' : '' }}">
        <i class="nav-icon far fa-plus-square"></i>
        <p>{{ __('Registrar ruta') }}</p>
      </a>
    </li>
  </ul>
</li>