@section('pendientes')
  <li class="nav-item dropdown" title="{{ __('Pendientes') }}">
    <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="far fa-clipboard"></i>
    <span class="badge badge-secondary navbar-badge"></span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
      <span class="dropdown-item dropdown-header"> {{ __('Filtros') }}</span>
      <div class="dropdown-divider"></div>
      {!! Form::model(Request::all(), ['route' => ['venta.pedidoTerminado.index', 'comentarioReclamacion'], 'method' => 'GET']) !!}
        <p class="dropdown-item">
          <span class="badge badge-warning"></span> 
          {!! Form::button(__('Comentario o Reclamación'), ['type' => 'submit', 'class' => 'btn btn-lift btn-sm p-0 m-0']) !!}
        </p>
        <div class="dropdown-divider"></div>
      {!! Form::close() !!}
    </div>
  </li>
@endsection