@section('js5')
<script>
  function getAlto() {
    alto = document.getElementById("alto").value;
    if (isNaN(parseFloat(alto))) {
      alto = 0;
    }
    alto = Number.parseFloat(alto).toFixed(2);
    document.getElementById("alto").value = alto
  }
  function getAncho() {
    ancho = document.getElementById("ancho").value;
    if (isNaN(parseFloat(ancho))) {
      ancho = 0;
    }
    ancho = Number.parseFloat(ancho).toFixed(2);
    document.getElementById("ancho").value = ancho
  }
  function getLargo() {
    largo = document.getElementById("largo").value;
    if (isNaN(parseFloat(largo))) {
      largo = 0;
    }
    largo = Number.parseFloat(largo).toFixed(2);
    document.getElementById("largo").value = largo
  }
  function getPeso() {
    peso = document.getElementById("peso").value;
    if (isNaN(parseFloat(peso))) {
      peso = 0;
    }
    peso = Number.parseFloat(peso).toFixed(3);
    document.getElementById("peso").value = peso
  }
</script>
@endsection