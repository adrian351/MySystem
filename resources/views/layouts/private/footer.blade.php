<footer class="main-footer p-1 text-center">
  <strong>
    {{ Sistema::datos()->sistemaFindOrFail()->emp_abrev }} - Copyright © {{ \Carbon\Carbon::parse(Sistema::datos()->sistemaFindOrFail()->year_de_ini)->year }} - {{ date("Y") }} 
    <span class="pantallaMax985px">
      <a href="{{ config('app.developer_url') }}" target="_blank" title="{{ config('app.developer_url') }}">{{ config('app.developer') }}</a>
      &nbsp{{ __('Todos los derechos reservados') }}.
    </span>
  </strong>
</footer>
<a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top"><i class="fas fa-chevron-up"></i></a>