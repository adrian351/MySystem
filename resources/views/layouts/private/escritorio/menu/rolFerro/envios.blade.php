<li class="nav-item has-treeview {{ Request::is('f/envio*') ? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ Request::is('f/envio*') ? 'active' : '' }}">
    <i class="nav-icon fas fa-shipping-fast"></i>
    <p>
      {{ __('Envios') }}
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ route('rolFerro.envioLocal.index') }}" class="nav-link {{ Request::is('f/envio-local') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list"></i>
        <p>{{ __('Lista de envios locales') }}</p>
      </a>
    </li>  
    <li class="nav-item">
      <a href="{{ route('rolFerro.envioForaneo.index') }}" class="nav-link {{ Request::is('f/envio-foraneo') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list"></i>
        <p>{{ __('Lista de envios foraneos') }}</p>
      </a>
    </li>  
  </ul>
</li>