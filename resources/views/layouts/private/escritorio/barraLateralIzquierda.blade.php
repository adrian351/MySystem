<a href="{{ Sistema::datos()->sistemaFindOrFail()->pag }}" class="brand-link {{ Auth::user()->col_logot }}" target="_blank" title="{{ Sistema::datos()->sistemaFindOrFail()->pag }}">
  <img src="{{ Sistema::datos()->sistemaFindOrFail()->log_neg_rut . Sistema::datos()->sistemaFindOrFail()->log_neg }}" alt="{{ Sistema::datos()->sistemaFindOrFail()->log_neg }}" class="brand-image rounded elevation-3 bg-light" style="opacity: .8">
  <span class="brand-text font-weight-light">{{ Sistema::datos()->sistemaFindOrFail()->emp_abrev }}</span>
</a>
<div class="sidebar">
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      @if(Auth::user()->img_us != null)
        <img src="{{ Auth::user()->img_us_rut . Auth::user()->img_us }}" class="img-circle elevation-2" alt="{{ Auth::user()->defau_img_perf }}">
      @else
        <img src="{{ Sistema::datos()->sistemaFindOrFail()->defau_img_perf_rut . Sistema::datos()->sistemaFindOrFail()->defau_img_perf }}" class="img-circle elevation-2" alt="{{ Sistema::datos()->sistemaFindOrFail()->defau_img_perf }}">
      @endif
    </div>
    <div class="info">
      <a href="{{ route('perfil.show') }}" class="d-block" target="_blank">{{ Auth::user()->nom }}<br>{{ Auth::user()->apell }}</a>
    </div>
  </div>
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-compact" data-widget="treeview" role="menu" data-accordion="false">
      @include('layouts.private.escritorio.menu')
    </ul>
  </nav>
</div>