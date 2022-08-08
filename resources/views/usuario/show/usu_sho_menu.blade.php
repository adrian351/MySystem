<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-2 p-1 rounded">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mx-auto">
      @can('usuario.show')
        <li class="nav-item">
          <a href="{{ route('usuario.show.actividad.index', Crypt::encrypt($usuario->id)) }}" class="nav-link {{ Request::is('usuario/detalles/actividad*') ? 'border rounded' : '' }}">
            <i class="fas fa-folder"></i> {{ __('Registro de actividades') }}
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('usuario.show', Crypt::encrypt($usuario->id)) }}" class="nav-link {{ Request::is('usuario/detalles/d*') ? 'border rounded' : '' }}">
            <i class="fas fa-eye"></i> {{ __('Detalles') }}
          </a>
        </li>
      @endcan
      @can('usuario.edit')
        <li class="nav-item">
          <a href="{{ route('usuario.edit', Crypt::encrypt($usuario->id)) }}" class="nav-link {{ Request::is('usuario/editar*') ? 'border rounded' : '' }}">
            <i class="fas fa-edit"></i> {{ __('Editar') }}
          </a>
        </li>
      @endcan
      @can('usuario.show')
        <li class="nav-item">
          <a href="{{ route('usuario.show.quejaYSugerencia.index', Crypt::encrypt($usuario->id)) }}" class="nav-link {{ Request::is('usuario/detalles/queja-y-sugerencia*') ? 'border rounded' : '' }}">
            <i class="fas fa-inbox"></i> {{ __('Quejas y sugerencias') }}
          </a>
        </li>
      @endcan
    </ul>
  </div>
</nav>