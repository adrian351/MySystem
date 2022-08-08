@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registrar salida').' '.$direccion->est)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <div class="float-right" style="margin-right: 4rem">
      @if(Request::route()->getName() == 'logistica.direccionLocal.create')
        @include('logistica.pedido.direccion_local.opciones')
      @elseif(Request::route()->getName() == 'logistica.direccionForaneo.create')
        @include('logistica.pedido.direccion_foraneo.opciones')
      @endif
    </div>
    <h5>
      <strong>{{ __('Registrar salida') }}: </strong>{{ $direccion->est }} ({{ Sistema::dosDecimales($direccion->cant) }}),
      <strong>{{ __('para el armado') }}: </strong> {{ $armado->cod }}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}"> 
      <small>{{ $direccion->id }}</small>
    </div>
  </div>
  <div class="card-body">
    <form @submit.prevent="create" enctype="multipart/form-data">
      @include('logistica.pedido.direccion_local.comprobante.com_createSalidaFields')
      <div class="row">
        <div class="form-group col-sm btn-sm">
          @if(Request::route()->getName() == 'logistica.direccionLocal.create')
            <a href="{{ route('logistica.direccionLocal.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
          @elseif(Request::route()->getName() == 'logistica.direccionForaneo.create')
            <a href="{{ route('logistica.direccionForaneo.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
          @endif
        </div>
        <div class="form-group col-sm btn-sm">
          <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Registrar') }}</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@section('css')
<style>
  #my_camera{
    width: 320px;
    height: 240px;
    border: 1px solid black;
  }
</style>
@endsection

@section('vuejs')
<script src="{{ asset('plugins/webcam-js/webcamjs/webcam.min.js') }}"></script>
<script>
  var app4 = new Vue({
    el: '#dashboard',
    data: {
      errors: [],
      costo_por_envio: "{{ $direccion->cost_por_env_log }}",
      metodos_de_entrega_especificos: [],
      metodo_de_entrega:            "{{ $direccion->met_de_entreg_de_log }}",
      metodo_de_entrega_especifico: "{{ $direccion->met_de_entreg_de_log_esp }}",
      comprobante_de_salida_nom: "{{ $direccion->comp_de_sal_nom }}",
      mydata: null
    },
    mounted() {
      this.getMetodosDeEntregaEspecificos()
    },
    methods: {
       create() {
        this.checarBotonSubmitDisabled("btnsubmit")
        fetch(mydata.value)
        .then(res => res.blob())
        .then(blob => {
          const formData = new FormData()
          formData.append('costo_por_envio', this.costo_por_envio)
          formData.append('metodo_de_entrega', this.metodo_de_entrega)
          formData.append('metodo_de_entrega_especifico', this.metodo_de_entrega_especifico)
          formData.append('comprobante_de_salida_nom', this.comprobante_de_salida_nom)
          if(blob.type != 'text/html') {
            formData.append('comprobante_de_salida', blob, 'filename')
          } else {
            formData.append('comprobante_de_salida', [])
          }
          formData.append('mydata', this.mydata)

          axios.post('/logistica/direccion/local/comprobante-de-salida/almacenar/'+{{ $direccion->id }}, formData, {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          }).then(res => {
            Swal.fire({
              title: 'Éxito',
              text: '¡Comprobante registrado exitosamente!',
            }).then((value) => {
              location.reload()
            })
          }).catch(error => {
            this.checarBotonSubmitEnabled("btnsubmit")
            if(error.response.status == 422) {
              this.errors = error.response.data.errors
            } else {
              Swal.fire({
                title: 'Algo salio mal',
                text: error,
              })
            }
          });
        });
      },
      async getDecimales() {
        costo_por_envio = document.getElementById("costo_por_envio").value;
        if (isNaN(parseFloat(costo_por_envio))) {
          costo_por_envio = 0;
        }
        costo_por_envio_decimal   = Number.parseFloat(costo_por_envio).toFixed(2);
        this.costo_por_envio = costo_por_envio_decimal;
      },
      async getMetodosDeEntregaEspecificos() {
        if(this.metodo_de_entrega != '') {
          axios.get('/logistica/direccion/metodo-de-entrega-espescifico/'+this.metodo_de_entrega).then(res => {
            this.metodos_de_entrega_especificos = res.data
            metodo_de_entrega_especifico = document.getElementById('metodo_de_entrega_especifico')
            metodo_de_entrega_especifico.style.display = 'none';
            if(Object.keys(res.data).length != 0) { 
              metodo_de_entrega_especifico.style.display = 'block';
            }
          }).catch(error => {
            Swal.fire({
              title: 'Algo salio mal',
              text: error,
            })
          });
        }
      },
      async checarBotonSubmitDisabled(id_btn) {
        document.getElementById(id_btn).value = "Espere un momento...";
        document.getElementById(id_btn).disabled = true;
        return true;
      },
      async checarBotonSubmitEnabled(id_btn) {
        document.getElementById(id_btn).value = "Espere un momento...";
        document.getElementById(id_btn).disabled = false;
        return true;
      },
      async quitarFoto() {
        document.getElementById('mydata').value = '';
        document.getElementById('results').innerHTML = 
            '<img src=""/>';
      },
      async capturarFoto() {
        var data_uri = Webcam.snap(function(data_uri, canvas, context) {
          document.getElementById('mydata').value = data_uri;
          document.getElementById('results').innerHTML = 
            '<img src="'+data_uri+'"/>';
        });
      },
      async getImage(event) {
        // Creamos el objeto de la clase FileReader
        let reader = new FileReader();

        // Leemos el archivo subido y se lo pasamos a nuestro fileReader
        reader.readAsDataURL(event.target.files[0]);

        // Le decimos que cuando este listo ejecute el código interno
        reader.onload = function(){
          let results = document.getElementById('results'),
                  image = document.createElement('img');

          image.src = reader.result;
          document.getElementById('mydata').value = reader.result;
          results.innerHTML = '';
          results.append(image);
        };
      },
    }
  });
  Webcam.set({
    width: 520,
    height: 440,
    dest_width: 640,
    dest_height: 480,
    image_format: 'jpeg',
    jpeg_quality: 90,
    force_flash: false
  });
  Webcam.attach('#my_camera');
</script>
@endsection