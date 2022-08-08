@section('js5')
<script>
  function getDecimal() {
    costo_por_envio = document.getElementById("costo_por_envio").value;
    if (isNaN(parseFloat(costo_por_envio))) {
      costo_por_envio = 0;
    }
    costo_por_envio = Number.parseFloat(costo_por_envio).toFixed(2);
    document.getElementById("costo_por_envio").value = costo_por_envio
  }
</script>
@endsection