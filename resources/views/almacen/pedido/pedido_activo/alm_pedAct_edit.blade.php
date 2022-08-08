 {{--
@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar pedido activo almacén').' '.$pedido->num_pedido)</title>
<div class="card {{ empty($pedido->per_reci_alm) ? config('app.color_card_warning') : config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ empty($pedido->per_reci_alm) ? config('app.color_bg_warning') : config('app.color_bg_primario') }}">
    <div class="float-right mr-5">
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.estatusAlmacenHeader')
    </div>
    <h5>
      <strong>{{ __('Editar pedido almacén') }}: </strong>
      @can('almacen.pedidoActivo.show')
        <a href="{{ route('almacen.pedidoActivo.show', Crypt::encrypt($pedido->id)) }}" class="text-white">{{ $pedido->num_pedido }}</a>
      @else
        {{ $pedido->num_pedido }}
      @endcan
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.entr_xprs_urg_foraneo_gratis')
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ empty($pedido->per_reci_alm) ? config('app.color_bg_warning') : config('app.color_bg_primario') }}"> 
      <small>{{ $pedido->num_pedido }}</small>
    </div>
  </div>
</div>
<div class="row">
  @can('almacen.pedidoActivo.edit')
    <div class="col-md-7">
      <div class="pad">
          <div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
            <div class="card-body">
              {!! Form::open(['route' => ['almacen.pedidoActivo.update', Crypt::encrypt($pedido->id)], 'method' => 'patch', 'id' => 'almacenPedidoActivoUpdate']) !!}
                @include('almacen.pedido.pedido_activo.alm_pedAct_editFields')
              {!! Form::close() !!}
            </div>
          </div>
      </div>
    </div>
  @endcan
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.numeroDePedidoUnificado', ['alto' => 'height: 17.6em;'])
</div>
@include('almacen.pedido.pedido_activo.armado_activo.alm_pedAct_armAct_index')
@endsection
--}}


@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar pedido activo almacén').' '.$pedido->num_pedido)</title>
<div class="card {{ empty($pedido->per_reci_alm) ? config('app.color_card_warning') : config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ empty($pedido->per_reci_alm) ? config('app.color_bg_warning') : config('app.color_bg_primario') }}">
    <div class="float-right mr-5">
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.estatusAlmacenHeader')
    </div>
    <h5>
      <strong>{{ __('Editar pedido almacén') }}: </strong>
      @can('almacen.pedidoActivo.show')
        <a href="{{ route('almacen.pedidoActivo.show', Crypt::encrypt($pedido->id)) }}" class="text-white">{{ $pedido->num_pedido }}</a>
      @else
        {{ $pedido->num_pedido }}
      @endcan
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.entr_xprs_urg_foraneo_gratis')
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ empty($pedido->per_reci_alm) ? config('app.color_bg_warning') : config('app.color_bg_primario') }}"> 
      <small>{{ $pedido->num_pedido }}</small>
    </div>
  </div>
</div>

<div class="row">
  @can('almacen.pedidoActivo.edit')
    <div class="col-md-7">
      <div class="pad">
          <div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
            <div class="card-body">
              <div class="row">
                <div class="form-group col-sm btn-sm">
                  <label for="persona_que_recibe">{{ __('Persona que recibe') }} *</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
                    </div>
                    {!! Form::text('persona_que_recibe', $pedido->per_reci_alm, ['id' => 'persona_que_recibe', 'class' => 'form-control' . ($errors->has('persona_que_recibe') ? ' is-invalid' : ''), 'maxlength' => 80, 'placeholder' => __('Persona que recibe'), 'onChange' => 'getLimpiar();']) !!}
                  </div>
                  <span class="text-danger" id="err_persona_que_recibe"></span>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-sm btn-sm">
                  <label for="comentario_almacen">{{ __('Comentario almacén') }}</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
                    </div>
                    {!! Form::textarea('comentario_almacen', $pedido->coment_alm, ['id' => 'comentario_almacen', 'class' => 'form-control' . ($errors->has('comentario_almacen') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Comentario almacén'), 'rows' => 4, 'cols' => 4]) !!}
                  </div>
                  <span class="text-danger" id="err_comentario_almacen"></span>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-sm btn-sm">
                  <label for="checkbox_imagen"></label>
                  <div class="input-group p-2">
                    <div class="custom-control custom-switch">
                      @if($pedido->img_firm == null)
                        {!! Form::checkbox('checkbox_imagen', 'on', true, ['id' => 'checkbox_imagen', 'class' => 'custom-control-input' . ($errors->has('checkbox_imagen') ? ' is-invalid' : '')]) !!}
                        <label class="custom-control-label" for="checkbox_imagen">{{ __('Guardar imagen') }}</label>
                      @else
                        {!! Form::checkbox('checkbox_imagen', 'off', false, ['id' => 'checkbox_imagen', 'class' => 'custom-control-input' . ($errors->has('checkbox_imagen') ? ' is-invalid' : ''), 'onClick' => 'check()']) !!}
                        <label class="custom-control-label" for="checkbox_imagen">{{ __('Remplazar imagen') }}</label>
                        <a href="{{ $pedido->img_firm_rut.$pedido->img_firm }}" class="btn btn-info border text-dark" target="_blank"><i class="fas fa-search-plus"></i></a>
                      @endif
                    </div>
                  </div>
                  <span class="text-danger">{{ $errors->first('checkbox_imagen') }}</span>
                  <canvas id="pizarra"></canvas>
                  <span class="text-danger" id="err_imagen"></span>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-sm btn-sm" >
                  <button type="button" id="limpiar" class="btn btn-info  w-100 p-2"><i class="fas fa-broom"></i> {{ __('Limpiar') }}</button>
                </div>
                <div class="form-group col-sm btn-sm">
                  <button type="button" id="guardar" class="btn btn-success w-100 p-2"><i class="fas fa-save"></i> {{ __('Guardar') }}</button>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  @endcan
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.numeroDePedidoUnificado', ['alto' => 'height: 17.6em;'])
</div>

@section('css')
<style>
  canvas {
      width: 700px;
      height: 200px;
      background-color: #fff;
      border: rgb(0, 0, 0) solid 1px;
  } 
</style>
@endsection

@section('js1')
<script>
  //======================================================================
  // VARIABLES
  //======================================================================
  let miCanvas = document.querySelector('#pizarra');
  let lineas = [];
  let correccionX = 0;
  let correccionY = 0;
  let pintarLinea = false;
  // Marca el nuevo punto
  let nuevaPosicionX = 0;
  let nuevaPosicionY = 0;

  let posicion = miCanvas.getBoundingClientRect()
  correccionX = posicion.x;
  correccionY = posicion.y;

  miCanvas.width = 700;
  miCanvas.height = 200;

  //======================================================================
  // FUNCIONES
  //======================================================================
  /**
   * Funcion que guarda la información
  */
  function check() {
    var checkbox_imagen = document.getElementById("checkbox_imagen").value;
    if(checkbox_imagen == 'on') {
      document.getElementById("checkbox_imagen").value = 'off';
    } else {
      document.getElementById("checkbox_imagen").value = 'on';
    }
  }
  var guardar = document.getElementById("guardar");
  guardar.addEventListener("click",function(){	
    miCanvas.src = miCanvas.toDataURL("image/png");

    document.getElementById('guardar').value = "Espere un momento...";
    document.getElementById('guardar').disabled = true;

    fetch(miCanvas.src)
      .then(res => res.blob())
      .then(blob => {
        const formData = new FormData()
        persona_que_recibe = document.getElementById("persona_que_recibe").value;
        comentario_almacen = document.getElementById("comentario_almacen").value;
        checkbox_imagen = document.getElementById("checkbox_imagen").value;
        
        formData.append('imagen', blob, 'filename');
        formData.append('persona_que_recibe', persona_que_recibe);
        formData.append('comentario_almacen', comentario_almacen);
        formData.append('checkbox_imagen', checkbox_imagen);

        axios.post('/almacen/pedido-activo/actualizar/'+{{ $pedido->id }}, formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        }).then(res => {
          Swal.fire({
            title: 'Éxito',
            text: '¡Pedido actualizado exitosamente!',
          }).then((value) => {
            location.reload()
          })
        }).catch(error => {
          if(error.response.status == 422) {
            errors = error.response.data.errors
            document.getElementById('guardar').disabled = false;


            document.getElementById("err_persona_que_recibe").innerHTML = null
            document.getElementById("err_comentario_almacen").innerHTML = null
            document.getElementById("err_imagen").innerHTML = null

            if(errors.persona_que_recibe != undefined) {
              document.getElementById("err_persona_que_recibe").innerHTML = errors.persona_que_recibe[0]
            }
            if(errors.comentario_almacen != undefined) {
              document.getElementById("err_comentario_almacen").innerHTML = errors.comentario_almacen[0]
            }
            if(errors.imagen != undefined) {
              document.getElementById("err_imagen").innerHTML = errors.imagen[0]
            }
          } else {
            Swal.fire({
              title: 'Algo salio mal',
              text: error,
            })
          }
        });
      });       
  },false);

  /**
   * Funcion que limpia lo que se escriba
  */
  var limpiar = document.getElementById("limpiar");
  limpiar.addEventListener('click', function(evt) {
    var ctx = miCanvas.getContext("2d");
    ctx.clearRect(0, 0, miCanvas.width, miCanvas.height);
    lineas = [];
    texto();
  }, false);


  function getLimpiar(){
    var ctx = miCanvas.getContext("2d");
    ctx.clearRect(0, 0, miCanvas.width, miCanvas.height);
    lineas = [];
    texto();
  }


  /**
   * Funcion que muentra el texto en el canvas
  */
  $(document).ready(texto);
  function texto(){
    let ctx = miCanvas.getContext('2d')

    var hoy = new Date();
    var fecha = hoy.getDate() + '/' + ( hoy.getMonth() + 1 ) + '/' + hoy.getFullYear();
    var hora = hoy.getHours() + ':' + hoy.getMinutes() + ':' + hoy.getSeconds();

    ctx.fillStyle = "#ffffff";        
    ctx.fillStyle = "#111";
    ctx.font="25px Monospace";
    ctx.fillText('Fecha:'+fecha +' - '+ hora, 5,20);
    ctx.fillText('Firma:', 5,50);
  };

  /**
   * Funcion que empieza a dibujar la linea
   */
  function empezarDibujo () {
      pintarLinea = true;
      lineas.push([]);
  };
  
  /**
   * Funcion que guarda la posicion de la nueva línea
   */
  function guardarLinea() {
      lineas[lineas.length - 1].push({
          x: nuevaPosicionX,
          y: nuevaPosicionY
      });
  }

  /**
   * Funcion dibuja la linea
   */
  function dibujarLinea (event) {
      event.preventDefault();
      if (pintarLinea) {
          let ctx = miCanvas.getContext('2d')

          // Estilos de linea
          ctx.lineJoin = ctx.lineCap = 'round';
          ctx.lineWidth = 1;
          // Color de la linea
          ctx.strokeStyle = '#000';
          // Marca el nuevo punto
          if (event.changedTouches == undefined) {
              // Versión ratón
              nuevaPosicionX = event.layerX;
              nuevaPosicionY = event.layerY;
          } else {
              // Versión touch, pantalla tactil
              nuevaPosicionX = event.changedTouches[0].pageX - correccionX;
              nuevaPosicionY = event.changedTouches[0].pageY - correccionY;
          }
          // Guarda la linea
          guardarLinea();
          // Redibuja todas las lineas guardadas
          ctx.beginPath();
          lineas.forEach(function (segmento) {
              ctx.moveTo(segmento[0].x, segmento[0].y);
              segmento.forEach(function (punto, index) {
                  ctx.lineTo(punto.x, punto.y);
              });
          });
          ctx.stroke();
      }
  }

  /**
   * Funcion que deja de dibujar la linea
   */
  function pararDibujar () {
      pintarLinea = false;
      guardarLinea();
  }

  //======================================================================
  // EVENTOS
  //======================================================================

  // Eventos raton
  miCanvas.addEventListener('mousedown', empezarDibujo, false);
  miCanvas.addEventListener('mousemove', dibujarLinea, false);
  miCanvas.addEventListener('mouseup', pararDibujar, false);

  // Eventos pantallas táctiles
  miCanvas.addEventListener('touchstart', empezarDibujo, false);
  miCanvas.addEventListener('touchmove', dibujarLinea, false);

</script>
@endsection

@php
  $contador1 = 0;
@endphp
<div class="card {{ config('app.color_card_secundario') }} card-outline">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_secundario') }}">
    @if(sizeof($productos) > 0)
      @if(Request::route()->getName() == 'almacen.pedidoActivo.edit')
        @can('almacen.pedidoActivo.armado.edit')
          <div class="float-right">
            {!! Form::open(['route' => ['almacen.pedidoActivo.marcarTodoCompleto.update', Crypt::encrypt($pedido->id)], 'method' => 'patch', 'id' => 'almacenPedidoActivoMarcarTodoCompletoUpdate']) !!}
              <button type="submit" id="btnsubmit1" class="btn btn-info btn-sm" onclick="return check('btnsubmit1', 'almacenPedidoActivoMarcarTodoCompletoUpdate', '¡Alerta!', '¿Estás seguro, quieres marcar todos los armados como productos completos?', 'info', 'Continuar', 'Cancelar', 'false');">{{ __('Marcar todo como completo') }}</button>
            {!! Form::close() !!}
          </div>
        @endcan
      @endcan
    @endif
    <h5><strong>{{ __('PRODUCTOS') }}</h5>
  </div>
  <div class="card-body">
    <div class="card-body table-responsive p-0" id="div-tabla-scrollbar2" style="height: 40em;">
      <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
        @if(sizeof($productos) == 0)
          @include('layouts.private.busquedaSinResultados')
        @else
          <tbody>
          @foreach($productos as $producto)
          <tr>
            <td>
              <div class="card p-0 m-0">
                <div class="card-header p-0 m-0" id="h{{ $producto['id_producto_origin'] }}">
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#a{{ $producto['id_producto_origin'] }}" aria-expanded="false" aria-controls="a{{ $producto['id_producto_origin'] }}">
                    <strong>{{ $producto['cantidad'] }} - {{ $producto['nombre_producto'] }}</strong>
                  </button>
                </div>
                <div id="a{{ $producto['id_producto_origin'] }}" class="collapse" aria-labelledby="h{{ $producto['id_producto_origin'] }}">
                  <div class="card-body p-1">
                    {!! Form::open(['route' => ['almacen.pedidoActivo.armado.sistituto.store', Crypt::encrypt([$producto['ids'],$producto['cantidad']])], 'onsubmit' => "return checarBotonSubmit('btnAlmacenPedidoActivoArmadoSistitutoStore$contador1')"]) !!}
                      <div class="form-group row p-0 m-0">
                        <div class="col-sm-12">
                          <div class="input-group-append">
                            {!! Form::text('cantidad', null, ['class' => 'form-control input-sm' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'maxlength' => 10, 'placeholder' => __('Cantidad')]) !!}
                            &nbsp&nbsp&nbsp{!! Form::select('sustituto', $producto['list_sustitutos'], [], ['class' => 'form-control select2 input-sm' . ($errors->has('sustituto') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
                            &nbsp&nbsp&nbsp<button type="submit" id="btnAlmacenPedidoActivoArmadoSistitutoStore{{ $contador1 }}" class="btn btn-info rounded" title="{{ __('Cargar') }}"><i class="fas fa-check-circle text-dark"></i></button>
                          </div>
                          <span class="text-danger">{{ $errors->first('cantidad') }}<br></span>
                          <span class="text-danger">{{ $errors->first('sustituto') }}</span>
                        </div>
                      </div>
                    {!! Form::close() !!}
                    @if(sizeof($producto['sustitutos']) == 0)
                    @else
                      <hr>
                      ***** {{ __('SUSTITUTOS') }}
                      @foreach($producto['sustitutos'] as $sustituto)
                        <div class="input-group text-muted ml-2">
                          <form method="post" action="{{ route('almacen.pedidoActivo.armado.sistituto.destroy', Crypt::encrypt($sustituto['ids'])) }}" id="almacenPedidoActivoArmadoSistitutoDestroy{{ $sustituto['id_producto'] }}">
                            @method('DELETE')@csrf
                            <button type="submit" id="btn{{ $sustituto['id_producto'] }}" class="btn btn-light p-0 m-0 rounded" title="{{ __('Eliminar') }}" onclick="return check('btn{{$sustituto['id_producto'] }}', 'almacenPedidoActivoArmadoSistitutoDestroy{{$sustituto['id_producto']}}', '¡Alerta!', '¿Estás seguro que quieres realizar esta acción?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="far fa-trash-alt"></i></button>
                            &nbsp
                          </form>
                          {{ $sustituto['cantidad'] }} - {{ $sustituto['producto'] }}
                        </div>
                      @endforeach
                    @endif
                  </div>
                </div>
              </div>
            </td>
          </tr>
          @php
            $contador1 ++;
          @endphp
          @endforeach
          </tbody>
        @endif
      </table>
    </div>
  </div>
</div>
@endsection