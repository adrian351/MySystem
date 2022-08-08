@section('js')
<script>
  function calculaUtilidad(precio_proveedor, utilidad, costo_armado) {
    precio_proveedor_costo_armado = Number.parseFloat(costo_armado) + Number.parseFloat(precio_proveedor);
    precio_cliente    = parseFloat(precio_proveedor_costo_armado) / (1- parseFloat(utilidad));
    precio_cliente    = Number.parseFloat(precio_cliente).toFixed(2);
    return precio_cliente;
  }
</script>
@endsection