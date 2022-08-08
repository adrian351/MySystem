<button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#menuPerfil" aria-controls="menuPerfil" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse order-3" id="menuPerfil">
  <a href="{{ Sistema::datos()->sistemaFindOrFail()->pag }}" class="navbar-brand" target="_blank" title="{{ Sistema::datos()->sistemaFindOrFail()->pag }}">
    <img src="{{ Sistema::datos()->sistemaFindOrFail()->log_neg_rut . Sistema::datos()->sistemaFindOrFail()->log_neg }}" alt="{{ Sistema::datos()->sistemaFindOrFail()->log_neg }}" class="brand-image rounded elevation-3 bg-light" style="opacity: .8">
  </a>
  <ul class="navbar-nav">
    <li class="nav-item pr-3">
      <a href="{{ route('home') }}" class="nav-link border border-warning rounded">
        <i class="fas fa-home"></i>
        {{ __('Inicio') }}
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('perfil.show') }}" class="nav-link {{ Request::is(['perfil/detalles', 'perfil/editar', 'perfil/personalizarSistema/editar', 'perfil/actividad']) ? 'active border rounded' : '' }}">
        <i class="far fa-address-card"></i>
        {{ __('Perfil') }}
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('perfil.notificacion.index') }}" class="nav-link {{ Request::is('perfil/notificacion*') ? 'active border rounded' : '' }}">
        <i class="far fa-bell"></i>
        {{ __('Notificaciones') }}
      </a>
    </li>
    @unlessrole(config('app.rol_cliente'))
      <li class="nav-item">
        <a href="{{ route('perfil.archivoGenerado.index') }}" class="nav-link {{ Request::is('perfil/archivos-generados*') ? 'active border rounded' : '' }}">
          <i class="fas fa-download"></i>
          {{ __('Archivos generados') }}
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('perfil.recordatorio.index') }}" class="nav-link {{ Request::is('perfil/recordatorio*') ? 'active border rounded' : '' }}">
          <i class="far fa-sticky-note"></i>
          {{ __('Recordatorios') }}
        </a>
      </li>
    @endunlessrole
  </ul>
</div>
<ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
  <li class="nav-item">
    <a href="javascript:location.reload()" class="nav-link" title="{{ __('Recargar') }}"><i class="fas fa-sync"></i></a>
  </li>
  @include('layouts.private.menuHeaderNotificaciones')
</ul>