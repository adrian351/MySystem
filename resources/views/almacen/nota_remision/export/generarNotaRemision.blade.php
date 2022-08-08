<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Nota de Remisión</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body style="font-family: Segoe UI;">
  <div>
    <div class="card">
      <center>
        <img src="{{ Sistema::datos()->sistemaFindOrFail()->log_neg_rut . Sistema::datos()->sistemaFindOrFail()->log_neg  }}" class="brand-image elevation-0" style="width:15rem;">
      </center>
    </div>
  </div>
  <div class="row">
    <table class="table table-sm table-bordered" style="font-size: 12px;">
      <tr>
        <td colspan="4" style="text-align:center">
          <h6>Nota de Remisión</h6>
        </td>
        <td style="text-align:center">
          No. {{ $nota->id }}
        </td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:center">
          Persona que aprueba: <p>{{ $nota->per_aprueba }}</p>
        </td>
        <td style="text-align:center">
          Persona que traslada: <p>{{ $nota->per_lleva }}</p>
        </td>
        <td style="text-align:center">
          Persona que recibe: <p>{{ $nota->per_recibe }}</p>
        </td>
        <td style="text-align:center">
          Fecha: <p>{{ date('d-m-Y', strtotime($nota->created_at)) }}</p>
        </td>
      </tr>
    </table>
  </div>
  <br/>
  <div class="row">
    <table class="table tbale-sm table-bordered table-hover" style="font-size: 12px;">
      <thead class="thead-light">
        <tr>
          <th>{{ __('PRODUCTO') }}</th>
          <th>{{ __('CANT_ENVIADA') }}</th>
          <th>{{ __('ALM_SALIDA') }}</th>
          <th>{{ __('ALM_ENTRADA') }}</th>
          <th>{{ __('CANT_RECIBIDA') }}</th>
          <th>{{ __('PRO_ID') }}</th>
        </tr>
      </thead>
      <tbody> 
          <tr>
            <td>{{ $nota->product }}</td>
            <td>{{ $nota->cant_envio }}</td>
            <td>{{ $nota->alm_sal }}</td>
            <td>{{ $nota->alm_ent }}</td>
            <td>{{ $nota->cant_recibida }}</td>
            <td>{{ $nota->producto_id }}</td>
          </tr>
      </tbody>
    </table>
  </div>
  <br/>
  <br/>
  <br/>
  <br/>
  @if($nota->coment != null)
  <div class="row">
    <div class="border border-dark rounded p-2">
      <h6>Comentario</h6> 
        <div class="form-group col-sm">
            {{ $nota->coment }}
        </div>
    </div>
  </div>
  @endif
</body>
</html>