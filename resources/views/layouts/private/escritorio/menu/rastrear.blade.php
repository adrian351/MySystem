@canany(['rastrea.pedido.show', 'rastrea.pedido.showFull'])
  <li class="nav-item">
    <a href="{{ route('rastrea.pedido.index') }}" class="nav-link {{ Request::is('rastrea/pedido*') ? 'active' : '' }}">
      <i class="nav-icon fas fa-search"></i>
      <p>{{ __('Rastrear pedido') }}</p>
    </a>
  </li>
@endcanany