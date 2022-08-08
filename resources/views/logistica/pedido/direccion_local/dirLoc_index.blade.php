@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Lista de direcciones locales'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('logistica.pedido.ped_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => 'logistica.direccionLocal.index', 'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['num_pag' => 50, 'ruta_recarga' => route('logistica.direccionLocal.index'), 'opciones_buscador' => config('opcionesSelect.select_logistica_direcciones_index')])
    {!! Form::close() !!}
    @include('logistica.pedido.direccion_local.dirLoc_table')
    @include('global.paginador.paginador', ['paginar' => $direcciones_locales])
  </div>
</div>
@endsection

{{--  @section('js5')
<script>
  const direcciones = @json($direcciones_locales);
  function autocompletado () {
    document.getElementById("resultado").innerHTML = '';

    for(i = 0; i < direcciones.data.length; i++) {
      var direccion = direcciones.data[i];
      //console.log(direccion.armado.pedido.fech_de_entreg);
    }

    var fechas = direccion.armado.pedido.fech_de_entreg;
    //console.log(fechas);

     var fecha = document.getElementById("buscardor").value;
     var tam = fecha.length;
     for(indice in fechas){
      var f = fechas[indice];
      var str = f.substring(0,tam);
      if(fecha.length <= f.length && fecha.length != 0 && f.length != 0){
        if(fecha.toLowerCase() == str.toLowerCase()){
          var node = document.createElement("LI");
          var textnode = document.createTextNode(fechas[indice]);
          node.appendChild(textnode);
          document.getElementById("resultado").appendChild(node);

        $('#resultado').html(textnode);
        }else {
          'no'
        }
      }
    }
  }
</script>
@endsection  --}}