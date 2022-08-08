@php
  $suma=0;
  $limite = 3000;
  $cortar = explode("-", $init);
@endphp
@foreach ($pedido_date as $pedido)
  @php
  $suma += $pedido->arm_carg; 
  @endphp 
@endforeach

  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="fecha_de_entrega">{{ __('Fecha de entrega') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-calendar-alt"></i></i></span>
        </div>
          @if ($pedido->fech_de_entreg == null)
            {!! Form::date('fecha_de_entrega', $init, ['class' => 'form-control', 'id' => 'entrega', 'min' =>$init]) !!}
            @else
            
              {!! Form::date('fecha_de_entrega', $pedido->fech_de_entreg, ['class' => 'form-control', 'id' => 'entrega', 'min' =>$init]) !!}
          @endif
      </div>
      <span class="text-danger">{{ $errors->first('fecha_de_entrega') }}</span>
    </div>
  </div>
  <div  id="nota_produccion" style="display: none">
    <div class="btn-sm-info">
      <button class=" btn_nota btn btn-danger" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        <strong>{{ '¡ NOTA ! ' }}</strong>
      </button>
      <span class="text-danger"> {{ __("Se ha producido un inconveniente ") }}</span>
    </div>  
    <div class="collapse" id="collapseExample">
      <div class="card card-body" style="background-color: #e7f3fe; border-left: 6px solid #2196F3;">
        <ul id="ul"></ul>
      </div>
    </div>
  </div>

@section('js6')
<script>

    $("#entrega").on('change', fechaEntrega);
    const limite = @json($limite);
    const pedido = @json($pedido_date);
    const total=  @json($totalarmados);
    {{--  const pedido_editado = @json($pedido);  --}}
    function fechaEntrega(){
      fechaDeEntrega = document.getElementById("entrega");
      fecha_de_entrega = fechaDeEntrega.value;
      nota = document.getElementById("nota_produccion");
      var fecha=[];
        fecha[0] = $(this).val();
        fecha[1]= total;
  
      $.get('/venta/pedido-activo/getfecha/'+fecha+'', function(data){ 
        //aqui si es true y si no te da msj
        var totalArmados = parseInt(data);
        var suma = totalArmados + fecha[1];
      
        var ul = '<li><span><h6 style="color:#CF0000">Se ha rebasado el límite de armados para producir.</h6></span><ul><li><span><h6 style="color:#CF0000">Límite de armados para producir por día: '+limite+' armados.</h6></span></li><li><span style="color:#CF0000"><h6>Su pedido es de : '+fecha[1]+' armados.</h6></span></li><li><span><h6 style="color:#CF0000">Por favor elija una fecha de entrega diferente.</h6></span></li></ul></li><li><span><h6>Total para entregar el día (' +fecha[0]+'): '+totalArmados+' armados.</h6></span></li>'
         
        $("#ul").html(ul);
        //console.log(totalArmados);
        if(totalArmados >= 3001  || suma >= 3001){
          nota.style.display = 'block';
          btnsubmit.style.display = 'none';
          //}else if(isNaN(totalArmados) ){
            //|| totalArmados <= 3000 
            //console.log(fecha[1])
            //nota.style.display = 'block';
            //btnsubmit.style.display = 'block';
            }else{
              nota.style.display = 'none';
              btnsubmit.style.display = 'block';
            }
      });
    }
</script>
@endsection

@section('css')
<style>
.btn_nota {
  
  animation-name: parpadeo;
  animation-duration: 2s;
  animation-timing-function: linear;
  animation-iteration-count: infinite;

  -webkit-animation-name:parpadeo;
  -webkit-animation-duration: 2s;
  -webkit-animation-timing-function: linear;
  -webkit-animation-iteration-count: infinite;
}

@-moz-keyframes parpadeo{  
  0% { opacity: 1.0; }
  50% { opacity: 0.0; }
  100% { opacity: 1.0; }
}

@-webkit-keyframes parpadeo {  
  0% { opacity: 1.0; }
  50% { opacity: 0.0; }
   100% { opacity: 1.0; }
}

@keyframes parpadeo {  
  0% { opacity: 1.0; }
   50% { opacity: 0.0; }
  100% { opacity: 1.0; }
}
</style>
@endsection






