@canany(['sistema.edit', 'manual.index', 'manual.create', 'manual.show', 'manual.edit', 'manual.destroy', 'sistema.plantilla.index', 'sistema.plantilla.create', 'sistema.plantilla.show', 'sistema.plantilla.edit', 'sistema.plantilla.destroy', 'sistema.notificacion.create', 'sistema.actividad.index', 'sistema.catalogo.index', 'sistema.catalogo.create', 'sistema.catalogo.show', 'sistema.catalogo.edit', 'sistema.catalogo.destroy', 'sistema.serie.index', 'sistema.serie.create', 'sistema.serie.show', 'sistema.serie.edit', 'sistema.serie.destroy'])
  <li class="nav-item has-treeview {{ Request::is('sistema*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is('sistema*') ? 'active' : '' }}">
      <i class="nav-icon fas fa-wrench"></i>
      <p>
        {{ __('Sistema') }}
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    @canany(['sistema.edit'])
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('sistema.edit') }}" class="nav-link {{ Request::is('sistema/editar') ? 'active' : '' }}">
            <i class="nav-icon"><img src="{{ Sistema::datos()->sistemaFindOrFail()->log_neg_rut . Sistema::datos()->sistemaFindOrFail()->log_neg }}" alt="{{ Sistema::datos()->sistemaFindOrFail()->log_neg }}" class="brand-image rounded elevation-2 bg-white" style="opacity: .7; width:2.5rem;"></i>
            <p>{{ Sistema::datos()->sistemaFindOrFail()->emp_abrev }}</p>
          </a>
        </li>
      </ul>
    @endcanany
    @canany(['manual.index', 'manual.create', 'manual.show', 'manual.edit', 'manual.destroy'])
      <ul class="nav nav-treeview">
        <li class="nav-item has-treeview {{ Request::is('sistema/manual*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::is('sistema/manual*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-book-open"></i>
            <p>
              <p>{{ __('Manuales') }}</p>
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @canany(['manual.index', 'manual.create', 'manual.show', 'manual.edit', 'manual.destroy'])
              <li class="nav-item">
                <a href="{{ route('manual.index') }}" class="nav-link {{ Request::is('sistema/manual') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-list"></i>
                  <p>{{ __('Lista de manuales') }}</p>
                </a>
              </li>
            @endcanany
            @can('manual.create')
            <li class="nav-item">
              <a href="{{ route('manual.create') }}" class="nav-link {{ Request::is('sistema/manual/crear') ? 'active' : '' }}">
                <i class="nav-icon far fa-plus-square"></i>
                <p>{{ __('Subir manual') }}</p>
              </a>
            </li>
          @endcan
          </ul>
        </li>
      </ul>
    @endcanany
    @canany(['sistema.plantilla.index', 'sistema.plantilla.create', 'sistema.plantilla.show', 'sistema.plantilla.edit', 'sistema.plantilla.destroy'])
      <ul class="nav nav-treeview">
        <li class="nav-item has-treeview {{ Request::is('sistema/plantilla*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::is('sistema/plantilla*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-brush"></i>
            <p>
              <p>{{ __('Plantillas') }}</p>
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @canany(['sistema.plantilla.index', 'sistema.plantilla.create', 'sistema.plantilla.show', 'sistema.plantilla.edit', 'sistema.plantilla.destroy'])
              <li class="nav-item">
                <a href="{{ route('sistema.plantilla.index') }}" class="nav-link {{ Request::is('sistema/plantilla') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-list"></i>
                  <p>{{ __('Lista de plantillas') }}</p>
                </a>
              </li>
            @endcanany
            @can('sistema.plantilla.create')
            <li class="nav-item">
              <a href="{{ route('sistema.plantilla.create') }}" class="nav-link {{ Request::is('sistema/plantilla/crear') ? 'active' : '' }}">
                <i class="nav-icon far fa-plus-square"></i>
                <p>{{ __('Crear plantilla') }}</p>
              </a>
            </li>
          @endcan
          </ul>
        </li>
      </ul>
    @endcanany
    @canany(['sistema.notificacion.create'])
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('sistema.notificacion.create') }}" class="nav-link {{ Request::is('sistema/notificacion*') ? 'active' : '' }}">
            <i class="nav-icon far fa-bell"></i>
            <p>{{ __('Enviar notificación') }}</p>
          </a>
        </li>
      </ul>
    @endcanany
    @canany(['sistema.actividad.index'])
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('sistema.actividad.index') }}" class="nav-link {{ Request::is('sistema/actividad*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-folder"></i>
            <p>{{ __('Registro de actividades') }}</p>
          </a>
        </li>
      </ul>
    @endcanany
    @canany(['sistema.catalogo.index', 'sistema.catalogo.create', 'sistema.catalogo.show', 'sistema.catalogo.edit', 'sistema.catalogo.destroy'])
      <ul class="nav nav-treeview">
        <li class="nav-item has-treeview {{ Request::is('sistema/catalogo*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::is('sistema/catalogo*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-book-open"></i>
            <p>
              <p>{{ __('Catálogos') }}</p>
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @canany(['sistema.catalogo.index', 'sistema.catalogo.create', 'sistema.catalogo.show', 'sistema.catalogo.edit', 'sistema.catalogo.destroy'])
              <li class="nav-item">
                <a href="{{ route('sistema.catalogo.index') }}" class="nav-link {{ Request::is('sistema/catalogo') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-list"></i>
                  <p>{{ __('Lista de catálogos') }}</p>
                </a>
              </li>
            @endcanany
            @can('sistema.catalogo.create')
            <li class="nav-item">
              <a href="{{ route('sistema.catalogo.create') }}" class="nav-link {{ Request::is('sistema/catalogo/crear') ? 'active' : '' }}">
                <i class="nav-icon far fa-plus-square"></i>
                <p>{{ __('Registrar catálogo') }}</p>
              </a>
            </li>
          @endcan
          </ul>
        </li>
      </ul>
    @endcanany
    @canany(['sistema.serie.index', 'sistema.serie.create', 'sistema.serie.show', 'sistema.serie.edit', 'sistema.serie.destroy'])
      <ul class="nav nav-treeview">
        <li class="nav-item has-treeview {{ Request::is('sistema/serie*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::is('sistema/serie*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-barcode"></i>
            <p>
              <p>{{ __('Series') }}</p>
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @canany(['sistema.serie.index', 'sistema.serie.create', 'sistema.serie.show', 'sistema.serie.edit', 'sistema.serie.destroy'])
              <li class="nav-item">
                <a href="{{ route('sistema.serie.index') }}" class="nav-link {{ Request::is('sistema/serie') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-list"></i>
                  <p>{{ __('Lista de series') }}</p>
                </a>
              </li>
            @endcanany
            @can('sistema.serie.create')
            <li class="nav-item">
              <a href="{{ route('sistema.serie.create') }}" class="nav-link {{ Request::is('sistema/serie/crear') ? 'active' : '' }}">
                <i class="nav-icon far fa-plus-square"></i>
                <p>{{ __('Registrar serie') }}</p>
              </a>
            </li>
          @endcan
          </ul>
        </li>
      </ul>
    @endcanany
  </li>
@endcanany