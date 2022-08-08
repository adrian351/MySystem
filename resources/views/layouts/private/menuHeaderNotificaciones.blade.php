@if(Request::route()->getName() != 'perfil.notificacion.index' AND Request::route()->getName() != 'perfil.notificacion.show')
  @if($notif = Auth::user()->unreadNotifications->where('type', 'App\Notifications\notificacion\NotificacionSent')->count()) <!-- Mostrar solo si existen notificaciones recibidas -->
  <li class="nav-item dropdown" title="{{ __('Notificaciones') }}">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>&nbsp;
        <span class="badge badge-warning navbar-badge">{{ $notif }}</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        @foreach(Auth::user()->unreadNotifications->where('type', 'App\Notifications\notificacion\NotificacionSent')->take(5) as $notificacion)
          <a href="{{ route($notificacion->data['rut'], array($notificacion->data['id_reg'], Crypt::encrypt($notificacion->id))) }}" class="dropdown-item">
            <small>
              <i class="far fa-bell mr-2"></i>
              {{ $notificacion->data['asunto'] }}
              <span class="float-right text-muted text-sm">{{ $notificacion->created_at->diffForHumans() }}</span>
            </small>
          </a>
          <div class="dropdown-divider"></div>
        @endforeach
        <a href="{{ route('perfil.notificacion.index') }}" class="dropdown-item dropdown-footer" {{ Request::is('perfil*') ? '' : 'target="_blank"' }}>{{ __('Ver todas las notificaciones') }}</a>
      </div>
    </li>
  @endif
@endif
@if(Request::route()->getName() != 'perfil.archivoGenerado.index')
  @if(Auth::user()->unreadNotifications->where('type', 'App\Notifications\servicio\NotificacionAchivoGenerado')->count()) <!-- Mostrar solo si existen descargas generadas -->
    <li class="nav-item dropdown" title="{{ __('Descargas generadas recientemente') }}">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-download"></i>&nbsp;
        <span class="badge badge-info navbar-badge"></span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">{{ __('Descargas generadas') }}</span>
        <div class="dropdown-divider"></div>
        @foreach(Auth::user()->unreadNotifications->where('type', 'App\Notifications\servicio\NotificacionAchivoGenerado')->take(5) as $notif_no_leidas)
          <a href="{{ $notif_no_leidas->data['arch_rut'].$notif_no_leidas->data['arch_nom'] }}" class="dropdown-item">
            <small>
              @if($notif_no_leidas->data['tip'] == 'XLSX')
                <i class="fas fa-file-excel"></i> 
              @elseif($notif_no_leidas->data['tip'] == 'PDF')
                <i class="fas fa-file-pdf"></i> 
              @endif
              {{ $notif_no_leidas->data['arch_nom_abrev'] }}<br> 
              <span class="float-right text-muted text-sm">{{ $notif_no_leidas->created_at->diffForHumans() }}</span>
            </small>
          </a>
          <div class="dropdown-divider"></div>
        @endforeach
        <a href="{{ route('perfil.archivoGenerado.index') }}" class="dropdown-item dropdown-footer" {{ Request::is('perfil*') ? '' : 'target="_blank"' }}>{{ __('Ver todas las descargas') }}</a>
      </div>
    </li>
  @endif
@endif
@if($record = Auth::user()->unreadNotifications->where('type', 'App\Notifications\NotificacionRecordatorio')->count()) <!-- Mostrar solo si existen recordatorios pendientes -->
  @if(Request::route()->getName() != 'perfil.recordatorio.index')
    <li class="nav-item dropdown" title="{{ __('Recordatorios') }}">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-sticky-note"></i>&nbsp;
        <span class="badge badge-info navbar-badge">3</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">3 {{ __(' Recordatorio(s) próximo(s)') }}</span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-stopwatch"></i> Maria Mendez
          <span class="float-right text-muted text-sm">31-12-2019</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-stopwatch"></i> Pedro
          <span class="float-right text-muted text-sm">8-01-2020</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-stopwatch"></i> Pago pendiente Juan
          <span class="float-right text-muted text-sm">02-01-2020</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{ route('perfil.recordatorio.index') }}" class="dropdown-item dropdown-footer" {{ Request::is('perfil*') ? '' : 'target="_blank"' }}>{{ __('Ver todos los recordatorios') }}</a>
      </div>
    </li>
  @endif
@endif
<li class="nav-item dropdown user-menu">
  <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
    {{ Auth::user()->nom }} <i class="fas fa-sort-down"></i>
  </a>
  <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
    <li class="user-header bg-white mb-3">
      @if(Auth::user()->img_us != null)
        <img src="{{ Auth::user()->img_us_rut . Auth::user()->img_us }}" class="img-circle elevation-2" alt="{{ Auth::user()->defau_img_perf }}">
      @else
        <img src="{{ Sistema::datos()->sistemaFindOrFail()->defau_img_perf_rut . Sistema::datos()->sistemaFindOrFail()->defau_img_perf }}" class="img-circle elevation-2" alt="{{ Sistema::datos()->sistemaFindOrFail()->defau_img_perf }}">
      @endif
      <p>
        {{ Auth::user()->nom }} {{ Auth::user()->apell }}
        <small>
          {{ Auth::user()->email }}<br>
          {{ __('Fecha de registro') }} {{ Auth::user()->created_at->isoFormat('lll') }}<br>
          {{ __('Último inicio de sesión') }} {{ Auth::user()->last_login }}<br>
        </small>
      </p>
    </li>
    <li class="user-footer">
      @if(!Request::is('perfil*'))
        <a href="{{ route('perfil.show') }}" class="btn btn-default btn-flat" target="_blank">
          <span class="text-muted "><i class="far fa-address-card"></i></span>
          {{ __('Perfil') }}
        </a>
      @endif
      <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-right" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        <span class="text-muted "><i class="fas fa-sign-out-alt"></i></span>
        {{ __('Cerrar sesión') }}
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
    </li>
  </ul>
</li>