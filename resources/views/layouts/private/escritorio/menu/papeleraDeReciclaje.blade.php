@canany(['papeleraDeReciclaje.index', 'papeleraDeReciclaje.destroy', 'papeleraDeReciclaje.restore'])
  <li class="nav-item">
    <a href="{{ route('papeleraDeReciclaje.index') }}" class="nav-link {{ Request::is('papelera-de-reciclaje*') ? 'active' : '' }}">
      <i class="nav-icon fas fa-recycle"></i>
      <p>{{ __('Papelera de reciclaje') }}</p>
    </a>
  </li>
@endcanany