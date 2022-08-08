@if($proveedor->arch_rut != null)
  <ul class="nav nav-pills float-right mr-5">
    <li class="nav-item dropdown ml-auto border rounded">
      <a class="nav-link text-white" data-toggle="dropdown" href="#">
        <i class="fas fa-archive"></i> {{ __('Archivos') }} <i class="fas fa-sort-down"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <a href="{{ $proveedor->arch_rut.$proveedor->arch_nom }}" class="dropdown-item" title="{{ __('Descargar') }}" download>{{ $proveedor->arch_nom }}</a>
        <div class="dropdown-divider"></div>
        </div>
    </li>
  </ul>
@endif