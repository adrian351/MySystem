
@section('js6')
<script>
  window.onload = function() { 
    getTipoDeEnvio();
  }
  function getTipoDeEnvio() {var
    select_tipo_de_descuento = document.getElementById("tipo_de_descuento"),
    tipo_de_descuento = select_tipo_de_descuento.value;
    opc_manual = document.getElementById('opc_manual');
    opc_porcentaje = document.getElementById('opc_porcentaje');
  
    if(tipo_de_descuento == 'Sin descuento') {
      opc_manual.style.display = 'none';
      opc_porcentaje.style.display = 'none';
    }
    if(tipo_de_descuento == 'Manual') {
      opc_manual.style.display = 'block';
      opc_porcentaje.style.display = 'none';
      getManualDecimal();
    }
    if(tipo_de_descuento == 'Porcentaje') {
      opc_porcentaje.style.display = 'block';
      opc_manual.style.display = 'none';
    }
  }
  function getManualDecimal() {
    // Obtiene los valores de los inputs
    manual = document.getElementById("manual").value;
   
    // Verifica si los inputs son de tipo float de lo contrario les asigan el valor de 0
    if (isNaN(parseFloat(manual))) {
      manual = 0;
    }

    // Agrega o solo deja dos decimales
    manual_decimal  = Number.parseFloat(manual).toFixed(2);
    document.getElementById("manual").value = manual_decimal;
  }
  function getCostoDeEnvioDecimal() {
    // Obtiene los valores de los inputs
    costo_de_envio = document.getElementById("costo_de_envio").value;
   
    // Verifica si los inputs son de tipo float de lo contrario les asigan el valor de 0
    if (isNaN(parseFloat(costo_de_envio))) {
      costo_de_envio = 0;
    }

    // Agrega o solo deja dos decimales
    costo_de_envio_decimal  = Number.parseFloat(costo_de_envio).toFixed(2);
    document.getElementById("costo_de_envio").value = costo_de_envio_decimal;
  }
</script>
@endsection