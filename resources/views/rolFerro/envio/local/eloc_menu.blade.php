<li class="nav-item">
  <a href="{{ route('rolFerro.envioLocal.index') }}" class="nav-link {{ Request::is('f/envio-local') ? 'active' : '' }}">
    <i class="fas fa-list nav-icon"></i> {{ __('Lista de envios locales') }}
  </a>
</li>
<li class="nav-item">
  <a href="{{ route('rolFerro.envioForaneo.index') }}" class="nav-link {{ Request::is('f/envio-foraneo') ? 'active' : '' }}">
    <i class="fas fa-list nav-icon"></i> {{ __('Lista de envios foraneos') }}
  </a>
</li>
<li class="nav-item ml-auto">
  <div class="btn-group dropleft">
    <button class="btn btn-light btn-sm border dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      {{ __('Reportes') }}
    </button>
    <div class="dropdown-menu">
      @if(Request::route()->getName()  == 'rolFerro.envioLocal.index')
        {!! Form::open(['route' => 'rolFerro.envioLocal.generarReporteDeLocales', 'method' => 'get']) !!}
          <button type="submit" id="btnsubmit1" class="dropdown-item"><i class="fas fa-file-excel"></i>  {{ __('Reporte de envios locales') }}</button>
        {!! Form::close() !!}
      @else
      {!! Form::open(['route' => 'rolFerro.envioForaneo.generarReporteDeForaneos', 'method' => 'get']) !!}
        <button type="submit" id="btnsubmit1" class="dropdown-item"><i class="fas fa-file-excel"></i>  {{ __('Reporte de envios foráneos') }}</button>
      {!! Form::close() !!}
      @endif
    </div>
  </div>
</li>