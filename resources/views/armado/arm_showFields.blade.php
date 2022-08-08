@include('armado.arm_showFields.imagen')
@include('armado.arm_showFields.created')
<div class="row">
  @include('armado.arm_showFields.nombre')
  @include('armado.arm_showFields.skuId')
</div>
<div class="row">
  @include('armado.arm_showFields.tipo')
  @include('armado.arm_showFields.stock')
</div>
<div class="row">
  @include('armado.arm_showFields.sku')
  @include('armado.arm_showFields.gama')

  @include('armado.arm_showFields.destacado')
  @include('armado.arm_showFields.urlPagina')
</div>
<div class="row">
  @include('armado.arm_showFields.precioDeCompra')
  @include('armado.arm_showFields.descuentoEspecial')

  @include('armado.arm_showFields.precioOriginal')
  @include('armado.arm_showFields.precioRedondeado')
</div>
@include('armado.arm_showFields.medidas')
@include('armado.arm_showFields.observaciones')
@section('js2')
<script>
  $('.select2').prop("disabled", true);
</script>
@endsection