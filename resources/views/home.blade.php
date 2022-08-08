@extends('layouts.private.escritorio.dashboard')
@section('titulo')
<div class="col-sm-12">
  {{--  <h1 class="m-0 text-dark text-center" > {{ __('Inicio') }}</h1>  --}}
</div>
@endsection
@section('contenido')
<title>@section('title', __('Inicio'))</title>
@if(auth()->user()->hasRole(config('app.rol_cliente')))
  <div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h3><i class="icon fas fa-info"></i> Info</h3>
    <h4>
      {{ __('Bienvenido a') }} {{ Sistema::datos()->sistemaFindOrFail()->emp }} {{ __('en este portal podrás darle seguimiento a tus pedidos, solicitar tus facturas y registrar tus pagos') }}.
    </h4>
  </div>
  <div class="alert alert-dark alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h3><i class="icon fas fa-info"></i> Info</h3>
    <h4>
      {{ __('Asegúrate de que este completa toda tu información en el sistema: Comprobante de pago cargado, factura solicitada, direcciones de entrega asignadas a cada partida del pedido') }}.
    </h4>
  </div>

  @php
    $año = date('Y');
    //$mas_1_año = date("Y",strtotime($año."+ 1 year"));
    $init = date('01-12-'.$año);
    $fin = date('30-12-'.$año);
  @endphp
  <div class="row">
    {{--  @if (date('d-m-Y') >= $init && date('d-m-Y') <= $fin)  --}}
    {{--  <div id="accordion" class="col-sm">
      <h5 class="mb-3">
        <button class="btn_alert btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          <h4 style="color: red"><i class="icon fas fa-info"></i> Importante ...</h4>
        </button>
      </h5>
      <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordion">
        <div class="card-body">
          <h5>
            <li>
              {{ __('
                Para pagos realizados del 1 al 15 de Diciembre, la fecha máxima de facturación será el 15 de Diciembre 
                .')}}
            </li><br/>
            <li>
              {{ __('
                Para pagos realizados del 16 al 22 de Diciembre, la fecha máxima de facturación será el 22 de Diciembre 
                .')}}
            </li><br/>
            <li>
              {{ __('
                Para pagos realizados del 23 al 29 de Diciembre, la fecha máxima de facturación será el 29 de Diciembre 
                .')}}
            </li><br/>
            <li>
              {{ __('Para pagos del 30 y 31 de Diciembre, la fecha máxima de facturación será el 31 de Diciembre.') }}
            </li><br/>
            <li>
              {{ __(' Si no facturas en este mes ya no se podrán generar facturas para 2022.') }}
            </li>
          </h5>
        </div>
      </div>
    </div>  --}}
    {{--  @endif    --}}
  </div>
  <div class="row">
    <div class="col-lg-3 col-6">
      <div class="tar small-box">
        <div class="inner-column">
          <h2>
            <a href="https://canastasyarcones.mx/contacto/" target="_blank" class="text-dark">{{ __('Cotizar') }} <i class="fas fa-arrow-circle-right"></i></a>
          </h2>
           <p>{{ __('Llenar formulario') }}</p>
        </div>
        <div class="icon">
          <i class="ion fas far fa-plus-square"></i>
        </div>
        <div id="cot">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseCot" aria-expanded="false" aria-controls="collapseThree">
              Leer más ...
            </button>
          </h5>
          <div id="collapseCot" class="collapse" aria-labelledby="headingThree" data-parent="#cot">
            <div class="card-body">
              Haga click en la flecha para ver nuestros productos.
            </div> 
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <div class="tar small-box">
        <div class="inner-column">
          <h2>
            <a href="{{ route('rolCliente.pedido.index') }}" class="text-dark">{{ __('Pedidos') }} <i class="fas fa-arrow-circle-right"></i></a>
            <br><br>
          </h2>
        </div>
        <div class="icon">
          <i class="ion fas fa-shopping-bag"></i>
        </div>
        <div id="ped">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsePed" aria-expanded="false" aria-controls="collapseThree">
              Leer más ...
            </button>
          </h5>
          <div id="collapsePed" class="collapse" aria-labelledby="headingThree" data-parent="#ped">
            <div class="card-body">
             De click en la flecha para visualizar todos sus pedidos.
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <div class="tar small-box">
        <div class="inner-column">
          <h2>
            <a href="{{ route('rolCliente.pago.index') }}" class="text-dark">{{ __('Pagos') }} <i class="fas fa-arrow-circle-right"></i></a>
            <br><br>
          </h2>
        </div>
        <div class="icon"> 
          <i class="ion fas far fa-plus-square"></i>
        </div>
        <div id="pag">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsePag" aria-expanded="false" aria-controls="collapseThree">
              Leer más ...
            </button>
          </h5>
          <div id="collapsePag" class="collapse" aria-labelledby="headingThree" data-parent="#pag">
            <div class="card-body">
              De click en la flecha para visualizar todos sus pagos.
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <div class="tar small-box">
        <div class="inner-column">
          <h2>
            <a href="{{ route('rolCliente.factura.index') }}" class="text-dark">{{ __('Facturas') }} <i class="fas fa-arrow-circle-right"></i></a>
            <br><br>
          </h2>
        </div>
        <div class="icon"> 
          <i class="ion fas far fa-plus-square"></i>
        </div>
          <div id="fact">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFact" aria-expanded="false" aria-controls="collapseThree">
                Leer más ...
              </button>
            </h5>
            <div id="collapseFact" class="collapse" aria-labelledby="headingThree" data-parent="#fact">
              <div class="card-body">
                De click en la flecha para poder visualizar todas sus facturas.
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
@endif

@endsection

@section('css')
<style>
  .tar {
    width: 100%;
    float: left;
    //margin-left: 10px;
    margin-right: 10px;
    padding: 15px;
    border-radius: 15px;
    -webkit-box-shadow: 5px 5px 10px rgb(0,0,0,0.1),
      -5px -5px 10px #fff;
    -moz-box-shadow: 5px 5px 10px rgb(0,0,0,0.1),
      -5px -5px 10px #fff;
    box-shadow: 5px 5px 10px rgb(0,0,0,0.1),
      -5px -5px 10px #fff;
    -webkit-transition: box-shadow 300ms;
    -moz-transition: box-shadow 300ms;
    transition: box-shadow 300ms;
  }
  
  .tar:hover {
    -webkit-box-shadow: 15px 15px 20px rgb(0,0,0,0.1),
      -15px -15px 20px #fff;
    -moz-box-shadow: 15px 15px 20px rgb(0,0,0,0.1),
      -15px -15px 20px #fff;
    box-shadow: 15px 15px 20px rgb(0,0,0,0.1),
      -10px -10px 10px #fff;
  }
  .btn_alert{
    width: 100%;
    border-radius: 15px;
    -webkit-box-shadow: 5px 5px 10px rgb(0,0,0,0.1),
      -5px -5px 10px #fff;
    -moz-box-shadow: 5px 5px 10px rgb(0,0,0,0.1),
      -5px -5px 10px #fff;
    box-shadow: 5px 5px 10px rgb(0,0,0,0.1),
      -5px -5px 10px #fff;
    -webkit-transition: box-shadow 300ms;
    -moz-transition: box-shadow 300ms;
    transition: box-shadow 300ms;
  }
  .btn_alert:hover {
    -webkit-box-shadow: 15px 15px 20px rgb(0,0,0,0.1),
      -15px -15px 20px #fff;
    -moz-box-shadow: 15px 15px 20px rgb(0,0,0,0.1),
      -15px -15px 20px #fff;
    box-shadow: 15px 15px 20px rgb(0,0,0,0.1),
      -10px -10px 10px #fff;
  }
  
</style>
@endsection

