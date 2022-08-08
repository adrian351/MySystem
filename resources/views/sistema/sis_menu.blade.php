<nav class="navbar navbar-expand-lg navbar-light  bg-light  mb-2 p-1 rounded border">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mx-auto">
      @can('sistema.edit')
        <li class="nav-item">
          <a href="{{ route('sistema.edit') }}" class="nav-link {{ Request::is('sistema/editar') ? 'bg-primary rounded' : '' }}">
            <i class=""><img src="{{ Sistema::datos()->sistemaFindOrFail()->log_neg_rut . Sistema::datos()->sistemaFindOrFail()->log_neg }}" alt="{{ Sistema::datos()->sistemaFindOrFail()->log_neg }}" class="brand-image rounded elevation-2 bg-white" style="opacity: .7; width:2.5rem;"></i>
            {{ Sistema::datos()->sistemaFindOrFail()->emp_abrev }}
          </a>
        </li>
      @endcan
      @canany(['manual.index', 'manual.create', 'manual.show', 'manual.edit', 'manual.destroy'])
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle {{ Request::is('sistema/manual*') ? 'bg-primary rounded' : '' }}" href="#" id="navbarManualMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-brush"></i>
            {{ __('Manuales') }}
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarManualMenu">
            @canany(['manual.index', 'manual.create', 'manual.show', 'manual.edit', 'manual.destroy'])
              <a href="{{ route('manual.index') }}" class="dropdown-item {{ Request::is('sistema/manual') ? 'active' : '' }}">
                <i class="nav-icon fas fa-list"></i>
                {{ __('Lista de manuales') }}
              </a>
            @endcanany
            @can('manual.create')
              <a href="{{ route('manual.create') }}" class="dropdown-item {{ Request::is('sistema/manual/crear') ? 'active' : '' }}">
                <i class="far fa-plus-square"></i>
                {{ __('Subir manual') }}
              </a>
            @endcan
          </div>
        </li>
      @endcanany
      @canany(['sistema.plantilla.index', 'sistema.plantilla.create', 'sistema.plantilla.show', 'sistema.plantilla.edit', 'sistema.plantilla.destroy'])
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle {{ Request::is('sistema/plantilla*') ? 'bg-primary rounded' : '' }}" href="#" id="navbarPlantillasMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-brush"></i>
            {{ __('Plantillas') }}
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarPlantillasMenu">
            @canany(['sistema.plantilla.index', 'sistema.plantilla.create', 'sistema.plantilla.show', 'sistema.plantilla.edit', 'sistema.plantilla.destroy'])
              <a href="{{ route('sistema.plantilla.index') }}" class="dropdown-item {{ Request::is('sistema/plantilla') ? 'active' : '' }}">
                <i class="nav-icon fas fa-list"></i>
                {{ __('Lista de plantillas') }}
              </a>
            @endcanany
            @can('sistema.plantilla.create')
              <a href="{{ route('sistema.plantilla.create') }}" class="dropdown-item {{ Request::is('sistema/plantilla/crear') ? 'active' : '' }}">
                <i class="far fa-plus-square"></i>
                {{ __('Crear plantilla') }}
              </a>
            @endcan
          </div>
        </li>
      @endcanany
      @can('sistema.notificacion.create')
        <li class="nav-item">
          <a href="{{ route('sistema.notificacion.create') }}" class="nav-link {{ Request::is('sistema/notificacion/enviar') ? 'bg-primary rounded' : '' }}">
            <i class="far fa-bell"></i>
            {{ __('Enviar notificación') }}
          </a>
        </li>
      @endcan
      @can('sistema.actividad.index')
        <li class="nav-item">
          <a href="{{ route('sistema.actividad.index') }}" class="nav-link {{ Request::is('sistema/actividad') ? 'bg-primary rounded' : '' }}">
            <i class="fas fa-folder"></i> 
            {{ __('Registro de actividades') }}
          </a>
        </li>
      @endcan
      @canany(['sistema.catalogo.index', 'sistema.catalogo.create', 'sistema.catalogo.show', 'sistema.catalogo.edit', 'sistema.catalogo.destroy'])
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle {{ Request::is('sistema/catalogo*') ? 'bg-primary rounded' : '' }}" href="#" id="navbarCatalogoMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-book-open"></i>
            {{ __('catálogos') }}
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarCatalogoMenu">
            @canany(['sistema.catalogo.index', 'sistema.catalogo.create', 'sistema.catalogo.show', 'sistema.catalogo.edit', 'sistema.catalogo.destroy'])
              <a href="{{ route('sistema.catalogo.index') }}" class="dropdown-item {{ Request::is('sistema/catalogo') ? 'active' : '' }}">
                <i class="nav-icon fas fa-list"></i>
                {{ __('Lista de catálogos') }}
              </a>
            @endcanany
            @can('sistema.catalogo.create')
              <a href="{{ route('sistema.catalogo.create') }}" class="dropdown-item {{ Request::is('sistema/catalogo/crear') ? 'active' : '' }}">
                <i class="far fa-plus-square"></i>
                {{ __('Registrar catalogo') }}
              </a>
            @endcan
          </div>
        </li>
      @endcanany
      @canany(['sistema.serie.index', 'sistema.serie.create', 'sistema.serie.show', 'sistema.serie.edit', 'sistema.serie.destroy'])
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle {{ Request::is('sistema/serie*') ? 'bg-primary rounded' : '' }}" href="#" id="navbarSerieMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-barcode"></i>
            {{ __('Series') }}
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarSerieMenu">
            @canany(['sistema.serie.index', 'sistema.serie.create', 'sistema.serie.show', 'sistema.serie.edit', 'sistema.serie.destroy'])
              <a href="{{ route('sistema.serie.index') }}" class="dropdown-item {{ Request::is('sistema/serie') ? 'active' : '' }}">
                <i class="nav-icon fas fa-list"></i>
                {{ __('Lista de series') }}
              </a>
            @endcanany
            @can('sistema.serie.create')
              <a href="{{ route('sistema.serie.create') }}" class="dropdown-item {{ Request::is('sistema/serie/crear') ? 'active' : '' }}">
                <i class="far fa-plus-square"></i>
                {{ __('Registrar serie') }}
              </a>
            @endcan
          </div>
        </li>
      @endcanany
    </ul>
  </div>
</nav>