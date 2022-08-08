<li class="nav-item">
  <a href="{{ route('rolCliente.pedido.index') }}" class="nav-link {{ Request::is('rc/pedido*') ? 'active' : '' }}">
    <i class="nav-icon fas fa-shopping-bag"></i>
    <p>{{ __('Pedidos') }}</p>
  </a>
</li>