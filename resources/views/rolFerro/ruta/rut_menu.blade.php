<li class="nav-item">
	<a href="{{ route('rolFerro.ruta.index') }}" class="nav-link {{ Request::is('f/ruta') ? 'active' : '' }}">
		<i class="fas fa-list nav-icon"></i> {{ __('Lista de rutas') }}
	</a>
</li>
<li class="nav-item">
	<a href="{{ route('rolFerro.ruta.create') }}" class="nav-link {{ Request::is('f/ruta/crear') ? 'active' : '' }}">
		<i class="fas fa-plus-square"></i> {{ __('Registrar ruta') }}
	</a>
</li>