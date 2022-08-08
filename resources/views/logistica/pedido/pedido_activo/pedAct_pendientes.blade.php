@section('pendientes')
  <li class="nav-item dropdown" title="{{ __('Pendientes') }}">
    <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="far fa-clipboard"></i>&nbsp;&nbsp;&nbsp;&nbsp;
    <span class="badge badge-secondary navbar-badge">{{ $pen->porEntregar+$pen->yaCaducados+$pen->pteDePago+$pen->pagoRechazado+$pen->pteDeInformacion+$pen->sinEntregaPorFaltaDeInformacion+$pen->intentoDeEntregaFallido+$pen->urgente  }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
      <span class="dropdown-item dropdown-header"> {{ __(' Pendientes') }}</span>
      <div class="dropdown-divider"></div>
      {!! Form::model(Request::all(), ['route' => ['logistica.pedidoActivo.index', 'porEntregar'], 'method' => 'GET']) !!}
        <p class="dropdown-item">
          <span class="badge badge-warning">{{ $pen->porEntregar }}</span> 
          {!! Form::button(__('Por entregar').' (+3d)', ['type' => 'submit', 'class' => 'btn btn-lift btn-sm p-0 m-0']) !!}
        </p>
        <div class="dropdown-divider"></div>
      {!! Form::close() !!}

      {!! Form::model(Request::all(), ['route' => ['logistica.pedidoActivo.index', 'yaCaducados'], 'method' => 'GET']) !!}
        <p class="dropdown-item">
          <span class="badge badge-warning">{{ $pen->yaCaducados }}</span> 
          {!! Form::button(__('Ya caducados').' (-5d)', ['type' => 'submit', 'class' => 'btn btn-lift btn-sm p-0 m-0']) !!}
        </p>
        <div class="dropdown-divider"></div>
      {!! Form::close() !!}

      {!! Form::model(Request::all(), ['route' => ['logistica.pedidoActivo.index', 'pteDePago'], 'method' => 'GET']) !!}
        <p class="dropdown-item">
          <span class="badge badge-warning">{{ $pen->pteDePago }}</span> 
          {!! Form::button(__('Pte. de pago'), ['type' => 'submit', 'class' => 'btn btn-lift btn-sm p-0 m-0']) !!}
        </p>
        <div class="dropdown-divider"></div>
      {!! Form::close() !!}

      {!! Form::model(Request::all(), ['route' => ['logistica.pedidoActivo.index', 'pagoRechazado'], 'method' => 'GET']) !!}
        <p class="dropdown-item">
          <span class="badge badge-warning">{{ $pen->pagoRechazado }}</span> 
          {!! Form::button(__('Pago rechazado'), ['type' => 'submit', 'class' => 'btn btn-lift btn-sm p-0 m-0']) !!}
        </p>
        <div class="dropdown-divider"></div>
      {!! Form::close() !!}

      {!! Form::model(Request::all(), ['route' => ['logistica.pedidoActivo.index', 'pteDeInformacion'], 'method' => 'GET']) !!}
        <p class="dropdown-item">
          <span class="badge badge-warning">{{ $pen->pteDeInformacion }}</span> 
          {!! Form::button(__('Pte. de información'), ['type' => 'submit', 'class' => 'btn btn-lift btn-sm p-0 m-0']) !!}
        </p>
        <div class="dropdown-divider"></div>
      {!! Form::close() !!}
      
      {!! Form::model(Request::all(), ['route' => ['logistica.pedidoActivo.index', 'sinEntregaPorFaltaDeInformacion'], 'method' => 'GET']) !!}
        <p class="dropdown-item">
          <span class="badge badge-warning">{{ $pen->sinEntregaPorFaltaDeInformacion }}</span> 
          {!! Form::button(__('Sin entrega por falta de info.'), ['type' => 'submit', 'class' => 'btn btn-lift btn-sm p-0 m-0']) !!}
        </p>
        <div class="dropdown-divider"></div>
      {!! Form::close() !!}

      {!! Form::model(Request::all(), ['route' => ['logistica.pedidoActivo.index', 'intentoDeEntregaFallido'], 'method' => 'GET']) !!}
        <p class="dropdown-item">
          <span class="badge badge-warning">{{ $pen->intentoDeEntregaFallido }}</span> 
          {!! Form::button(__('Intento de entrega fallido'), ['type' => 'submit', 'class' => 'btn btn-lift btn-sm p-0 m-0']) !!}
        </p>
        <div class="dropdown-divider"></div>
      {!! Form::close() !!}

      {!! Form::model(Request::all(), ['route' => ['logistica.pedidoActivo.index', 'urgente'], 'method' => 'GET']) !!}
        <p class="dropdown-item">
          <span class="badge badge-warning">{{ $pen->urgente }}</span> 
          {!! Form::button(__('Urgentes'), ['type' => 'submit', 'class' => 'btn btn-lift btn-sm p-0 m-0']) !!}
        </p>
        <div class="dropdown-divider"></div>
      {!! Form::close() !!}
    </div>
  </li>
@endsection