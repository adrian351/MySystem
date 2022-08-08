<div class="row justify-content-center fixed-bottom bg-white">
  <strong>
    {{ Sistema::datos()->sistemaFindOrFail()->emp_abrev }} - Copyright © {{ \Carbon\Carbon::parse(Sistema::datos()->sistemaFindOrFail()->year_de_ini)->year }} - {{ date("Y") }} 
    <span class="pantallaMax985px">
      <a href="{{ config('app.developer_url') }}" target="_blank" title="{{ config('app.developer_url') }}">{{ config('app.developer') }}</a>
      &nbsp{{ __('Todos los derechos reservados.') }}
    </span>
  </strong>
</div>