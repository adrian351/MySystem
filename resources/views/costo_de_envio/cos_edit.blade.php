@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar costo de envío').' '.$costo_de_envio->est)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar registro') }}: </strong>
      @can('costoDeEnvio.show')
        <a href="{{ route('costoDeEnvio.show', Crypt::encrypt($costo_de_envio->id)) }}" class="text-white">{{ $costo_de_envio->est }}</a>
      @else
        {{ $costo_de_envio->est }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}"> 
      <small>{{ $costo_de_envio->id }}</small>
    </div>
  </div>
  <div class="card-body">
    <form @submit.prevent="update" enctype="multipart/form-data">
      @include('costo_de_envio.cos_createFields')
      <div class="row">
        <div class="form-group col-sm btn-sm">
          <a href="{{ route('costoDeEnvio.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
        </div>
        <div class="form-group col-sm btn-sm">
          <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar') }}</button>
        </div>
      </div>
    {{--   @include('layouts.private.plugins.priv_plu_select2') --}}
    </form>
  </div>
</div>
@endsection

@section('vuejs')
<script>
  var app4 = new Vue({
    el: '#dashboard',
    data: {
      errors:                         [],
      metodos_de_entrega:             [],
      metodos_de_entrega_especificos: [],
      estados:                        [],
      tipos_de_envio:                 [],
      unitario_o_total:               "unitario",
      municipios:                     [],

      concatenado:                  "",
      foraneo_o_local:              "{{ $costo_de_envio->for_loc }}",
      metodo_de_entrega:            "{{ $costo_de_envio->met_de_entreg }}",
      metodo_de_entrega_especifico: "{{ $costo_de_envio->met_de_entreg_esp }}",
      cantidad:                     "{{ $costo_de_envio->cant }}",
      transporte:                   "{{ $costo_de_envio->trans }}",
      estado:                       "{{ $costo_de_envio->est }}",
      total_o_unitario:             "{{ $costo_de_envio->tot_unit }}",
      municipio:                    "{{ $costo_de_envio->mun }}",
      tipo_de_envio:                "{{ $costo_de_envio->tip_env }}",
      tamano:                       "{{ $costo_de_envio->tam }}",
      aplicar_costo_de_caja:        "{{ $costo_de_envio->aplic_cos_caj }}",
      cuenta_con_seguro:            "{{ $costo_de_envio->seg }}",
      tiempo_de_entrega:            "{{ $costo_de_envio->tiemp_ent }}",
      costo_por_envio:              "{{ $costo_de_envio->cost_por_env }}"
    },
    computed: {
      metChico: function () {
        if(this.metodo_de_entrega == 'Transportes Ferro' && this.tipo_de_envio == 'Consolidado') {
          return "{{ env('COSTO_CHICO_ESP') }}"
        } else {
      
          return "{{ env('COSTO_CHICO') }}"
        }
      },
      metMediano: function () {
        if(this.metodo_de_entrega == 'Transportes Ferro' && this.tipo_de_envio == 'Consolidado') {
          return "{{ env('COSTO_MEDIANO_ESP') }}"
        } else {
      
          return "{{ env('COSTO_MEDIANO') }}"
        }
      },
      metGrande: function () {
        if(this.metodo_de_entrega == 'Transportes Ferro' && this.tipo_de_envio == 'Consolidado') {
          return "{{ env('COSTO_GRANDE_ESP') }}"
        } else {
      
          return "{{ env('COSTO_GRANDE') }}"
        }
      }
    },
    mounted() {
      this.getMetodosDeEntrega(1)
      this.getTiposDeEnvio(1)
      this.tipPaqueteria(1)
      this.getMunicipios()
      this.getUnitarioOTotal()
    },
    methods: {
      async update() {
        event.preventDefault();   
        Swal.fire({
          title: '¡Alerta!',
          text: '¿Estás seguro quieres actualizar el registro?',
          type: 'info',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Continuar',
          cancelButtonText: 'Cancelar',
          reverseButtons: true,
        }).then((result) => {
          if (result.value) {
            this.checarBotonSubmitDisabled("btnsubmit")
            this.getConcatenado()
            axios.put('/costo-de-envio/actualizar/'+{{ $costo_de_envio->id }}, {
              registro:                     this.concatenado,
              foraneo_o_local:              this.foraneo_o_local,
              metodo_de_entrega:            this.metodo_de_entrega,
              metodo_de_entrega_especifico: this.metodo_de_entrega_especifico,
              cantidad:                     this.cantidad,
              transporte:                   this.transporte,
              estado:                       this.estado,
              total_o_unitario:             this.total_o_unitario,
              municipio:                    this.municipio,
              tipo_de_envio:                this.tipo_de_envio,
              tamano:                       this.tamano,
              aplicar_costo_de_caja:        this.aplicar_costo_de_caja,
              cuenta_con_seguro:            this.cuenta_con_seguro,
              tiempo_de_entrega:            this.tiempo_de_entrega,
              costo_por_envio:              this.costo_por_envio,
              tipos_de_envio:               this.tipos_de_envio,
            }).then(res => {
              Swal.fire({
                title: 'Éxito',
                text: '¡Costo de envío actualizado exitosamente!',
              }).then((value) => {
                location.reload()
              })
            }).catch(error => {
              this.checarBotonSubmitEnabled("btnsubmit")
              if(error.response.status == 422) {
                this.errors   = error.response.data.errors
              } else {
                Swal.fire({
                  title: 'Algo salio mal',
                  text: error,
                })
              }
            });
          }
        });
      },
      async getConcatenado() {
        this.concatenado = ""
        if(this.foraneo_o_local != null) {
          this.concatenado += this.foraneo_o_local
        }
        if(this.metodo_de_entrega != null) {
          this.concatenado += this.metodo_de_entrega
        }
        if(this.metodo_de_entrega_especifico != null) {
          this.concatenado += this.metodo_de_entrega_especifico
        }
        if(this.cantidad != null) {
          this.concatenado += this.cantidad
        }
        if(this.transporte != null) {
          this.concatenado += this.transporte
        }
        if(this.estado != null) {
          this.concatenado += this.estado
        }
        if(this.total_o_unitario != null) {
          this.concatenado += this.total_o_unitario
        }
        if(this.municipio != null) {
          this.concatenado += this.municipio
        }
        if(this.tipo_de_envio != null) {
          this.concatenado += this.tipo_de_envio
        }
        if(this.tamano != null) {
          this.concatenado += this.tamano
        }
        if(this.aplicar_costo_de_caja != null) {
          this.concatenado += this.aplicar_costo_de_caja
        }
        if(this.cuenta_con_seguro != null) {
          this.concatenado += this.cuenta_con_seguro
        }
        if(this.tiempo_de_entrega != null) {
          this.concatenado += this.tiempo_de_entrega
        }
        if(this.costo_por_envio != null) {
          this.concatenado += this.costo_por_envio
        }
      },
      async getMetodosDeEntrega($val) {
        if($val == 2) {
          this.metodo_de_entrega            = null
          this.metodo_de_entrega_especifico = null
          this.cantidad                     = null
          this.transporte                   = null
          this.estado                       = null
          this.total_o_unitario             = null
          this.tipo_de_envio                = null
          this.getUnitarioOTotal()

          metodo_de_entrega_especifico  = document.getElementById('metodo_de_entrega_especifico')
          metodo_de_entrega_especifico.style.display = 'none';

          divtotal_o_unitario  = document.getElementById('divtotal_o_unitario')
          divtotal_o_unitario.style.display = 'none';

          cantidad  = document.getElementById('divcantidad')
          cantidad.style.display = 'none';

          transporte  = document.getElementById('divtransporte')
          transporte.style.display = 'none';

          tipo_de_envio  = document.getElementById('tipo_de_envio')
          tipo_de_envio.style.display = 'none';
        }

        if(this.foraneo_o_local != '') {
          this.getForLoc()
          // TREA TODOS LOS METODOS DE ENTREGA CORRESPONDIENTES
          axios.get('/logistica/direccion/metodo-de-entrega/'+this.foraneo_o_local).then(res => {
            this.metodos_de_entrega = res.data
            metodo_de_entrega = document.getElementById('metodo_de_entrega')
            metodo_de_entrega.style.display = 'none';
            if(Object.keys(res.data).length != 0) { 
              metodo_de_entrega.style.display = 'block';
            }
          }).catch(error => {
            Swal.fire({
              title: 'Algo salio mal',
              text: error,
            })
          }); 
          this.getEstados()
        }
      },
      async getEstados() {
        // TREA TODOS LOS ESTADOS CORRESPONDIENTES
        axios.get('/estado/obtener/'+this.foraneo_o_local).then(res => {
          this.estados = res.data
          estado = document.getElementById('estado')
          estado.style.display = 'none';
          if(Object.keys(res.data).length != 0) { 
            estado.style.display = 'block';
          }
        }).catch(error => {
          Swal.fire({
            title: 'Algo salio mal',
            text: error,
          })
        });
      },
      async getMunicipios() {
        municipio  = document.getElementById('municipio')
        municipio.style.display = 'none';

        $estad = '';
        for (var i = 0; i< this.estado.length; i++) {
          var caracter = this.estado.charAt(i);
          if(caracter == "(") {
            break;
          } else {
            $estad = $estad + caracter;
          }
          
        }
        $estad.substring(0, $estad.length - 2);

        if($estad != 'Tarifa única ') {
          axios.get('https://api-sepomex.hckdrk.mx/query/get_municipio_por_estado/'+$estad).then(res => {
            this.municipios = res.data.response.municipios;
            municipio.style.display = 'block';
          }).catch(error => {
            Swal.fire({
              title: 'Algo salio mal',
              text: error,
            })
          });
        }
      },
      async getTiposDeEnvio($val) {
        if($val == 2) {
          this.metodo_de_entrega_especifico = null
          this.cantidad                     = null
          this.transporte                   = null
          this.tipo_de_envio                = null
          this.getUnitarioOTotal()

        if(this.metodo_de_entrega == 'Transportes Ferro') {
          this.unitario_o_total = "total";
        }
          metodo_de_entrega_especifico  = document.getElementById('metodo_de_entrega_especifico')
          metodo_de_entrega_especifico.style.display = 'none';
          
          cantidad  = document.getElementById('divcantidad')
          cantidad.style.display = 'none';

          transporte  = document.getElementById('divtransporte')
          transporte.style.display = 'none';

          tipo_de_envio  = document.getElementById('tipo_de_envio')
          tipo_de_envio.style.display = 'none';
        }

        // TREA TODOS LOS METODOS DE ENVIO
        if(this.metodo_de_entrega != '') {
          axios.get('/metodo-de-entrega/obtener/'+this.metodo_de_entrega).then(res => {
            this.tipos_de_envio = res.data
            tipo_de_envio = document.getElementById('tipo_de_envio')
            tipo_de_envio.style.display = 'none';
            if(Object.keys(res.data).length != 0) { 
              tipo_de_envio.style.display = 'block';
            }
          }).catch(error => {
            Swal.fire({
              title: 'Algo salio mal',
              text: error,
            })
          });
        }
        if(this.metodo_de_entrega == 'Paquetería') {
          this.getMetodosDeEntregaEspecificos()
        } else if(this.metodo_de_entrega == 'Transportes Ferro') {
          transporte  = document.getElementById('divtransporte')
          transporte.style.display = 'block';
        } else {
          metodo_de_entrega_especifico = document.getElementById('metodo_de_entrega_especifico')
          metodo_de_entrega_especifico.style.display = 'none';
        }
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
      async tipPaqueteria($val) {
        cantidad  = document.getElementById('divcantidad')

        if($val == 2) {
          this.cantidad                     = null
          this.tipo_de_envio                = null
          
          cantidad.style.display = 'none';
        }

        if(this.metodo_de_entrega_especifico == 'TresGuerras') {
          cantidad.style.display = 'block';
        }
      },
      async getTipoDeEnvio() {
        this.getForLoc()
        this.getUnitarioOTotal()
        if(this.tipo_de_envio == "Directo") {
          this.tiempo_de_entrega = "Express";
        }
      },
      async getUnitarioOTotal() {
        this.unitario_o_total = "unitario";
        if(this.tipo_de_envio == "Consolidado" || this.tipo_de_envio == "Directo") {
          this.unitario_o_total = "total";
        }
      },
      async getForLoc() {
        if(this.foraneo_o_local == 'Local') {
          this.tiempo_de_entrega = 'De 1 a 4 dias'
          divtotal_o_unitario  = document.getElementById('divtotal_o_unitario')
          divtotal_o_unitario.style.display = 'block';
        } else {
          this.tiempo_de_entrega = 'De 7 a 10 dias'
        }
      },
      async getDecimal() {
        costo_por_envio = document.getElementById("costo_por_envio").value;
        if (isNaN(parseFloat(costo_por_envio))) {
          costo_por_envio = 0;
        }
        costo_por_envio_decimal   = Number.parseFloat(costo_por_envio).toFixed(2);
        this.costo_por_envio = costo_por_envio_decimal;
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
      }
    }
  });
</script>
@endsection