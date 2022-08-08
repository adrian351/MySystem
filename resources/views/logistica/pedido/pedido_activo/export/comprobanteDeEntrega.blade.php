<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Comprobante de entrega {{ $direccion->est }}</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body style="font-family: Segoe UI;">
  <table class="table table-sm table-bordered" style="font-size:15px;">
    <tr>
      <td colspan="4" style="text-align:center">
        <dt><img src="{{ Sistema::datos()->sistemaFindOrFail()->log_neg_rut . Sistema::datos()->sistemaFindOrFail()->log_neg }}" class="brand-image rounded elevation-0" style="width:10rem;"></dt>
        <dt><a href="{{ Sistema::datos()->sistemaFindOrFail()->pag }}" target="_blank">{{ Sistema::datos()->sistemaFindOrFail()->pag }}</a></dt>
      </td>
      <td colspan="8" style="font-size:10px;">
        {{--  nombre de la empresa  --}}
          <dt>{{ Sistema::datos()->sistemaFindOrFail()->emp }}</dt>
          
          <dt>{{ Sistema::datos()->sistemaFindOrFail()->direc_uno }}</dt>
          <dt>{{ Sistema::datos()->sistemaFindOrFail()->corr_vent }}</dt>
          <dt>{{ Sistema::datos()->sistemaFindOrFail()->lad_fij }} {{ Sistema::datos()->sistemaFindOrFail()->tel_fij }} ext. {{ Sistema::datos()->sistemaFindOrFail()->ext }}</dt>
          <dt>{{ Sistema::datos()->sistemaFindOrFail()->lad_mov }} {{ Sistema::datos()->sistemaFindOrFail()->tel_mov }}</dt>
      </td>
    </tr>
    <tr>
      <td colspan="6" style="text-align:center">
        <dt >Fecha de entrega</dt>
        <dt >{{ $pedido->fech_de_entreg }}</dt>
      </td>
      <td colspan="6" style="text-align:center">
        <dt >RACK</dt>
        <dt >{{ $armado->ubic_rack }}</dt>
      </td>
    </tr>
    <tr>
      <td colspan="12">
        {{--  poner una direccion por default con : Alcaldia, Municipio  --}}
        <dt class="text-center" style="font-size:65px;">{{ $direccion->cod }}</dt>
      </td>
    </tr>
    <tr>
      <td colspan="12">
        <dt class="text-center" style="font-size:50px;">
          @if($direccion->for_loc == 'Local')
            {{ $direccion->del_o_munic }}
             @else
              {{ $direccion->est }} 
          @endif
        </dt>
        @if($direccion->nom_ref_uno != null)
          <p>
            <strong>Nombre de la persona que recibe uno: </strong>{{ $direccion->nom_ref_uno }}<br>
            <strong>Nombre de la persona que recibe dos: </strong>{{ $direccion->nom_ref_dos }}<br>

            <strong>Teléfono fijo: </strong>({{ $direccion->lad_fij }}) {{ $direccion->tel_fij }} <strong>Ext.</strong> {{ $direccion->ext }},
            <strong>Teléfono móvil: </strong>({{ $direccion->lad_mov }}) {{ $direccion->tel_mov }}<br>

            <strong>C. </strong>{{ $direccion->calle }} 
            <strong>Nro.</strong> {{ $direccion->no_ext }} 
            <strong>int.</strong> {{ $direccion->no_int }},
            <strong>País</strong> {{ $direccion->pais }},
            <strong>Ciudad</strong> {{ $direccion->ciudad }},
            <strong>Colonia</strong> {{ $direccion->col }},
            <strong>Delegación o municipio </strong> {{ $direccion->del_o_munic }},
            <strong>C.P.</strong> {{ $direccion->cod_post }} <br>
            {{-- que pendiente de revision --}}
            <strong>Zona: Ciudad de México y Área metropolitana</strong><br/>
            <strong>Referencias zona de entrega: </strong>{{ $direccion->ref_zon_de_entreg }}<br>
          </p>
        @endif
      </td>
    </tr>
    <tr class="text-center">
      <td colspan="12">
        <dt>SALIDA DE ALMACÉN</dt>
      </td>
    </tr>
    <tr>
      <td colspan="4">
        <dt class="text-center"><br><br><hr style="width:50%">Nombre y firma de almacén</dt>
      </td>
      <td colspan="8">
        <dt class="text-center"><br><br><hr style="width:50%">Nombre y firma de repartidor</dt>
      </td>
    </tr>
    <tr class="text-center" style="background:#9b9b9b">
      <td colspan="12">
        <dt>COMPROBANTE DE ENTREGA</dt>
      </td>
    </tr>
    <tr style="background:#9b9b9b">
      <td colspan="7">
        <dt class="text-center"><h5>Al firmar este documento confirmo que recibo el pedido completo y en buenas condiciones</h5></dt>
        <dt>Nombre cliente:</dt>
        <dt>Fecha de entrega:</dt>
        <dt>Total de productos recibidos:</dt>
        <dt>Comentarios:</dt>
      </td>
      <td colspan="5" class="text-center">
        <br><br><br><br><hr>
        <dt>Firma del cliente</dt>
      </td>
    </tr>
    <tr>
      <td colspan="4" class="text-center">
        <p>Cargar comprobante de salida</p>
        <img src="data:image/svg;base64, {!! base64_encode($codigoQRDComprobanteDeSalida) !!} ">
      </td>
      <td colspan="8" class="text-center">
        <p>Cargar comprobante de entrega</p>
        <img src="data:image/svg;base64, {!! base64_encode($codigoQRDComprobanteDeEntrega) !!} ">
      </td>
    </tr>
  </table>
  <table class="table table-hover table-striped table-sm table-bordered" style="font-size:12px;">
    <thead class="thead-dark">
      <tr>
        <th>#</th>
        <th>CANTIDAD</th>
        <th>PRODUCTO</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{ $armado->cod }}</td>
        <td>{{ $direccion->cant }}</td>
        <td>
          <strong>{{ $armado->nom }} ({{ $armado->sku }})</strong><br>
          @foreach($armado->productos as $producto)
            <div class="input-group text-muted ml-2">
              <u>[{{ $producto->cant }} - {{ $producto->produc }}]</u>
            </div>
            @foreach($producto->sustitutos as $sustituto)
              <div class="input-group text-muted ml-4">
                {{ $sustituto->cant }} - {{ $sustituto->produc }}
              </div>
            @endforeach
          @endforeach
        </td>
      </tr>
    </tbody>
  </table> 
</body>
</html>