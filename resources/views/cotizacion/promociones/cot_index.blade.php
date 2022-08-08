<div class="card card-danger">
  <div class="card-header p-1 border-bottom bg-danger">
    <h5>{{ __('PROMOCIONES QUE APLICAN PARA ESTA COTIZACIÓN (Para desplegar promociones favor de cargar las direcciones de entrega de cada armado.)') }}</h5>
  </div>
  <div class="card-body">
    <div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 15em;">
      <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
          <tbody>
              @include('cotizacion.promociones.cot_1cada50')
              @php 
                $cant_direcciones1 = 0;
                $cant_direcciones2 = 0;
                $cant_direcciones3 = 0;
                $cant_direcciones4 = 0;
              @endphp  
              @foreach($armados as $armado)
                @foreach($armado->direcciones as $direccion)
                  @include('cotizacion.promociones.cot_enviosCDMXyMetropolitano')
                  @include('cotizacion.promociones.cot_arribaDe20Mil')
                  @include('cotizacion.promociones.cot_arribaDe50Mil')
                  @include('cotizacion.promociones.cot_arribaDe70Mil')
                @endforeach
                @php
                  $cant_direcciones1 = 0;
                  $cant_direcciones2 = 0;
                  $cant_direcciones3 = 0;
                  $cant_direcciones4 = 0;
                @endphp  
              @endforeach
            </td>
          </tbody>
      </table>
    </div>
  </div>
</div>