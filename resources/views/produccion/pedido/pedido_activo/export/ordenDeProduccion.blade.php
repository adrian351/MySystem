<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Orden de producción {{ $pedido->num_pedido }}</title>
  {{--  de el modulo de produccion  --}}
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body style="font-family: Segoe UI;">
  <table class="table table-sm table-bordered" style="font-size:12px;margin-right:1rem;">
    <tr>
      <td colspan="2" style="text-align:center">
        <dt><img src="{{ Sistema::datos()->sistemaFindOrFail()->log_neg_rut . Sistema::datos()->sistemaFindOrFail()->log_neg }}" class="brand-image rounded elevation-0" style="width:10rem;"></dt>
        <dt><a href="{{ Sistema::datos()->sistemaFindOrFail()->pag }}" target="_blank">{{ Sistema::datos()->sistemaFindOrFail()->pag }}</a></dt>
      </td>
      <td colspan="2">
        <dt>{{ Sistema::datos()->sistemaFindOrFail()->emp }}</dt>
        <dt>{{ Sistema::datos()->sistemaFindOrFail()->direc_uno }}</dt>
        <dt>{{ Sistema::datos()->sistemaFindOrFail()->corr_vent }}</dt>
        <dt>{{ Sistema::datos()->sistemaFindOrFail()->lad_fij }} {{ Sistema::datos()->sistemaFindOrFail()->tel_fij }} ext. {{ Sistema::datos()->sistemaFindOrFail()->ext }}</dt>
        <dt>{{ Sistema::datos()->sistemaFindOrFail()->lad_mov }} {{ Sistema::datos()->sistemaFindOrFail()->tel_mov }}</dt>
      </td>
      <td colspan="8">
        <dt><h5>Orden de producción</h5></dt>
        <dt>{{ date("Y-m-d G:i:s") }}</dt>
      </td>
    </tr>
    <tr style="text-align:center">
      <td colspan="2">
        <dt>Número de pedido:</dt>
        <dt style="font-size:30px;">{{ $pedido->num_pedido }}</dt>
        {{--  @foreach ($armados as $armado)
          @foreach ($armado->direcciones as $direccion)
              @if ($direccion->tip_tarj_felic == 'Personalizada' || 'Diseñada por el cliente' || 'Estandar' || 'Entregada por el cliente' || 'Sin tarjeta')  --}}

                    {{--  <dt>Tarjeta:<h6 style="font-size:1.2em;" > {{ $direccion->tip_tarj_felic}}</h6></dt>  --}}
                 {{--  @else  --}}
                 {{-- si no es personalizada no pintamos nada --}}
              {{--  @endif 
            @endforeach
        @endforeach      --}}
                {{-- @php
                   $cantidad = 0;
                @endphp
            
                  @php
                     $cantidad += $direccion->cant
                  @endphp
                  <dt>Tarjeta:<h6 style="font-size:1.5em;"> {{ $cantidad }}- {{ $direccion->tip_tarj_felic }}</h6></dt> --}}
      </td>
      {{-- <tr>
        <td>Tarjeta</td>
      </tr> --}}
      <td colspan="3">
        <dt>Pedido unificado:</dt>
        <dt>
          @foreach($pedido->unificar as $unificado)
            [{{ $unificado->num_pedido }}</a>] 
          @endforeach
        </dt>
      </td>
      <td colspan="7">
        <dt>Fecha de Entrega:</dt>
        <dt style="font-size:30px;">{{ $pedido->fech_de_entreg }}</dt>
      </td>
    </tr>

    <tr>
      <td colspan="12" style="font-size:1.2em;" >
        <strong><center>{{ 'Tarjeta (s): ' }}</center></strong>
        {{-- queda pendiente su mejora --}}
        @foreach ($armados as $armado)
        @foreach ($armado->direcciones as $direccion)
            {{--  @if ($direccion->tip_tarj_felic == 'Personalizada' || 'Diseñada por el cliente' || 'Estandar' || 'Entregada por el cliente' || 'Sin tarjeta')  --}}
              <strong> [{{ $direccion->cant }}- {{ $direccion->tip_tarj_felic}}] </strong>
                
             {{--  @endif   --}}
          @endforeach
      @endforeach    
      </td>
    </tr>

    <tr style="text-align:center">
      <td colspan="6">
        <dt>Cliente</dt>
        <dt>{{ $pedido->usuario->nom }} ({{ $pedido->usuario->email_registro }})</dt>
      </td>
      {{--  <td colspan="2">
        @if($archivos >= 1)
          <dt>sss</dt>
        @endif
      </td>  --}}
      <td colspan="6">
        <dt>Total de armados</dt>
        <dt>{{ $pedido->arm_carg }} de {{ $pedido->tot_de_arm }}</dt>
      </td>
    </tr>
    <tr style="text-align:center">
      <td colspan="6">
        <dt>Comentarios generales ventas</dt>
        <dt>
          @if($pedido->coment_vent == null)
            Sin comentarios
          @else
            {{ $pedido->coment_vent }}
          @endif
        </dt>
      </td>
      <td colspan="6">
        <dt>Archivos</dt>
        <dt>
          @foreach ($pedido->archivos as $a)
          <div class="card">
            <div class="card-header p-0" style="border-radius:  1em">
                <a href="{{ $a->arc_rut.$a->arc_nom}}"  class="btn btn-link btn-sm">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $a->nom_visual}}
                </a>
              </div>
          </div>
          @endforeach
        </dt>
      </td>
    </tr>
    <tr style="text-align:center">
      <td colspan="12">
        <dt>Comentarios generales cliente</dt>
        <dt>
          @if($pedido->coment_client == null)
            Sin comentarios
          @else
            {{ $pedido->coment_client }}
          @endif
        </dt>
      </td>
    </tr>
    <tr>
      <td colspan="2" class="text-center">
        <p>QR Almacén</p>
        <img src="data:image/svg;base64, {!! base64_encode($codigoQRAlmacen) !!} ">
      </td>
      <td colspan="2" class="text-center">
        <p>QR Producción</p>
        <img src="data:image/svg;base64, {!! base64_encode($codigoQRProduccion) !!} ">
      </td>
      <td colspan="5" class="text-center">
        <p>QR Logística</p>
        <img src="data:image/svg;base64, {!! base64_encode($codigoQRLogistica) !!} ">
      </td>
      <td colspan="3"></td>
    </tr>
  </table>
  <table class="table table-hover table-striped table-sm table-bordered" style="font-size:12px;margin-right:1rem;margin-bottom:0px">
    @if(sizeof($armados) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead class="thead-dark">
        <tr>
          <th>#</th>
          <th>CANT</th>
          <th>TIPO</th>
          <th width="20%">ARMADO</th>
          <th>RACK</th>
          <th>COM. VENTAS</th>
          <th>COM. CLIENTE</th>
          <th width="12%">DEDIC.</th>
        </tr>
      </thead>
      <tbody>
        @foreach($armados as $armado)
          <tr>
            <td style="font-size:15px;">{{ $armado->cod }}</td>
            <td>{{ $armado->cant }}</td>
            <td>{{ $armado->tip }}</td>
            <td>
              <strong>{{ $armado->nom }} ({{ $armado->sku }})</strong><br>
              @foreach($armado->productos as $producto)
                <div class="input-group text-muted ml-2">
                  <p class="m-0">[{{ $producto->cant }} - {{ $producto->produc }}]</p>
                </div>
                @foreach($producto->sustitutos as $sustituto)
                  <div class="input-group text-muted ml-4">
                    <p class="m-0">{{ $sustituto->cant }} - {{ $sustituto->produc }}</p>
                  </div>
                @endforeach
              @endforeach
              <div class="input-group text-muted ml-2">
                <p class="m-0">- - - - - - - - - - - </p>
              </div>
              @foreach($armado->direcciones as $direccion)
                <div class="input-group text-muted ml-2">
                  <p class="m-0">{{ $direccion->cant }} - {{ $direccion->caj }}</p>
                </div>
              @endforeach

            </td>
            <td>{{ $armado->ubic_rack }}</td>
            <td>
              @if($armado->coment_vent == null)
                Sin comentarios
              @else
                {{ $armado->coment_vent }}
              @endif
            </td>
            <td>
              @if($armado->coment_client == null)
                Sin comentarios
              @else
                {{ $armado->coment_client }}
              @endif            
            </td>
            <td>
              @foreach($armado->direcciones as $direccion)
                <div class="input-group">
                  <p class="m-0">{{ $direccion->cant }} - {{ $direccion->tip_tarj_felic }}</p>
                </div>
                @if ($direccion->tip_tarj_felic == 'Personalizada')
                  <div>
                    <p class="m-0"> <strong>"{{ $direccion->mens_dedic }}"</strong> </p>
                  </div>
                @endif
              @endforeach
            </td>
          </tr>
        @endforeach
      </tbody>
    @endif
  </table> 
</body>
</html>