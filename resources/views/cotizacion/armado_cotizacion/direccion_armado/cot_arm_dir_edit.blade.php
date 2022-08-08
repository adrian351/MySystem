@extends('layouts.private.escritorio.dashboard') 
@section('contenido')
<title>@section('title', __('Editar dirección').' '.$direccion->est)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar dirección') }}: </strong>{{ $direccion->est }}
      <strong>{{ __('del armado') }}: </strong>{{ $direccion->armado->nom }}
    </h5>  
  </div>
  <div class="card-body">
    <form @submit.prevent="edit" enctype="multipart/form-data">
      @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_createFields')
      <div class="row">
        <div class="form-group col-sm btn-sm">
          <a href="{{ route('cotizacion.armado.edit', Crypt::encrypt($direccion->armado->id)) }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Continuar con el armado') }}</a>
        </div>
        <div class="form-group col-sm btn-sm">
          <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Actualizar dirección') }}</button>
        </div>
      </div>
    </form>
  </div>
</div>
@include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_costosDeEnvio')
@endsection

@section('vuejs')
<script>
  var app4 = new Vue({
    el: '#dashboard',
    data: {               
      errors: [],
      hasError: false,
      costos: [],
      filtrar: [
        metodo_de_entrega  = null,
        estado             = null,
        tipo_de_envio      = null,
      ],
      tamano:              "{{ $armado->tam }}",

      // CAMPOS BLOQUEADO
      foraneo_o_local:              "{{ $direccion->for_loc }}",
      metodo_de_entrega:            "{{ $direccion->met_de_entreg }}",
      metodo_de_entrega_especifico: "{{ $direccion->met_de_entreg_esp }}",
      cantid:                       "{{ $direccion->cant }}",
      transporte:                   "{{ $direccion->trans }}",
      estado_al_que_se_cotizo:      "{{ $direccion->est }}",
      total_o_unitario:             "{{ $direccion->tot_unit }}",
      municipio:                    "{{ $direccion->mun }}",
      tipo_de_envio:                "{{ $direccion->tip_env }}",
      taman:                        "{{ $direccion->tam }}",
      costo_de_caja:                "{{ $direccion->cost_tam_caj }}",
      cuenta_con_seguro:            "{{ $direccion->seg }}",
      tiempo_de_entrega:            "{{ $direccion->tiemp_ent }}",
      costo_de_envio_individual:    "{{ $direccion->cost_por_env_individual }}",
      costo_de_envio:               "{{ $direccion->cost_por_env }}",
      // CAMPOS DESBLOQUEADOS
      cantidad:                 "{{ $direccion->cant }}",
      detalles_de_la_ubicacion: "{{ $direccion->detalles_de_la_ubicacion }}",
      // OTROS
      costo_seleccionado: [],
      cost_por_env:       null,
    },
    mounted() {
      this.getCostos()
    },
    methods: {
      async edit() {     
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
            axios.put('/cotizacion/armado/direccion/actualizar/'+{{ $direccion->id }}, {
              cantidad:                 this.cantidad,
              detalles_de_la_ubicacion: this.detalles_de_la_ubicacion,
              costo_seleccionado:       this.costo_seleccionado
            }).then(res => {
              Swal.fire({
                title: 'Éxito',
                text: '¡Dirección actualizada exitosamente!',
              }).then((value) => {
                location.reload()
              })
            }).catch(error => {
              this.checarBotonSubmitEnabled("btnsubmit")
              if(error.response.status == 422) {
                this.errors   = error.response.data.errors,
                this.hasError = true
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
      async getCostos() {
        var urlCostos = '/costo-de-envio/obtener';
        axios.get(urlCostos, {
          params: {
            metodo_de_entrega:  this.filtrar.metodo_de_entrega,
            estado:             this.filtrar.estado,
            tipo_de_envio:      this.filtrar.tipo_de_envio,
            tamano:             this.tamano, 
          }
        }).then(res => {
          this.costos = res.data
        }).catch(error => {
          Swal.fire({
            title: 'Algo salio mal',
            text: error,
          })
        });
      },
      async getCostoSeleccionado(costo_env) {
        this.costo_seleccionado           = costo_env
        this.foraneo_o_local              = costo_env.for_loc
        this.metodo_de_entrega            = costo_env.met_de_entreg
        this.metodo_de_entrega_especifico = costo_env.met_de_entreg_esp
        this.cantid                       = costo_env.cant
        this.transporte                   = costo_env.trans
        this.estado_al_que_se_cotizo      = costo_env.est
        this.total_o_unitario             = costo_env.tot_unit
        this.municipio                    = costo_env.mun
        this.tipo_de_envio                = costo_env.tip_env
        this.taman                        = costo_env.tam
        this.costo_de_caja                = costo_env.cost_tam_caj
        this.cuenta_con_seguro            = costo_env.seg
        this.tiempo_de_entrega            = costo_env.tiemp_ent
        this.costo_de_envio_individual    = costo_env.cost_por_env
        this.costo_de_envio               = costo_env.cost_por_env
        this.getCostoDeEnvio()
      },
      async getCostoDeEnvio() {
        // VERIFICA SI EL OBJETO "costo_seleccionado" ESTA VACIO O NO
        if(Object.keys(this.costo_seleccionado).length === 0) {
          if(this.estado_al_que_se_cotizo == 'Ciudad de México (Ciudad de México)' || this.estado_al_que_se_cotizo == 'México (Edo. México)') {
            if(this.total_o_unitario == 'Total') {
              this.cost_por_env = parseFloat(this.costo_de_envio_individual)
            } else if(this.total_o_unitario == 'Unitario') {
              this.cost_por_env = parseFloat(this.costo_de_envio_individual) * parseFloat(this.cantidad)
            }
          } else if(this.tipo_de_envio == 'Consolidado' || this.tipo_de_envio == 'Directo') {
            this.cost_por_env = parseFloat(this.costo_de_envio_individual)
          } else {
            this.cost_por_env = parseFloat(this.costo_de_envio_individual) * parseFloat(this.cantidad)
          }
        } else {
          if(this.estado_al_que_se_cotizo == 'Ciudad de México (Ciudad de México)' || this.estado_al_que_se_cotizo == 'México (Edo. México)') {
            if(this.total_o_unitario == 'Total') {
              this.cost_por_env = parseFloat(this.costo_seleccionado.cost_por_env)
            } else if(this.total_o_unitario == 'Unitario') {
              this.cost_por_env = parseFloat(this.costo_seleccionado.cost_por_env) * parseFloat(this.cantidad)
            }
          } else if(this.tipo_de_envio == 'Consolidado' || this.tipo_de_envio == 'Directo') {
            this.cost_por_env = parseFloat(this.costo_seleccionado.cost_por_env)
          } else {
            this.cost_por_env = parseFloat(this.costo_seleccionado.cost_por_env) * parseFloat(this.cantidad)
          }
        }
        if(this.costo_seleccionado.cost_tam_caj > 0) {
          this.cost_por_env += this.costo_seleccionado.cost_tam_caj *  parseFloat(this.cantidad); 
        } else if(this.costo_de_caja > 0) {
          this.cost_por_env += this.costo_de_caja *  parseFloat(this.cantidad); 
        }

        if (isNaN(parseFloat(this.cost_por_env))) {
          this.cost_por_env = this.costo_de_envio
        }
        this.costo_de_envio = Number.parseFloat(this.cost_por_env).toFixed(2)

        if (isNaN(parseFloat(this.cost_por_env))) {
          this.costo_de_envio = null
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
    }
  });
</script>
@endsection