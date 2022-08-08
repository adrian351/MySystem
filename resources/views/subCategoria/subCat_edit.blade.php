@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar subCategoria').' '.$subCategoria->subcategoria)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar registro') }}: </strong>
      {{--  @can('armado.show')
        <a href="{{ route('armado.show', Crypt::encrypt($armado->id)) }}" class="text-white">{{ $armado->nom }}</a>
      @else  --}}
        {{ $subCategoria->subcategoria}}
      {{--  @endcan  --}}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}"> 
      <small>{{ $subCategoria->id }}</small>
    </div>
  </div>
</div>
@can('subCategoria.edit')
  <div class="card  card-outline card-tabs position-relative bg-white">
    <div class="card-body">
      {!! Form::open(['route' => ['subCategoria.update', Crypt::encrypt($subCategoria->id)], 'method' => 'patch', 'id' => 'subCategoriaUpdate']) !!}
        <div class="row">
            <div class="form-group col-sm btn-sm"> 
              <label for="categoria">{{ __('Categoría') }}*</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-level-up-alt"></i></span>
                  </div>
                  <select class="form-control select2" aria-label="Default select example" placeholder="selecciona"  name="categoria[]">
                    <option  ></option>
                      @for ($i = 0; $i <count($categoria_list); $i++)
                        {{ $encontrado ="false" }}
                          @for ($a = 0; $a <count($subCategoria->categoria); $a++)
                            @if($categoria_list[$i]->id==$subCategoria->categoria[$a]->id)
                              {{ $encontrado="true" }}
                            @endif 
                          @endfor
                        @if($encontrado=="true")    
                          <option value="{{ $categoria_list[$i]->id }}" selected>{{ $categoria_list[$i]->categoria}}</option>
                            @else
                              <option value="{{ $categoria_list[$i]->id }}" >{{ $categoria_list[$i]->categoria}} </option>
                        @endif 
                      @endfor
                    </select>
                </div>
            </div>
            <div class="form-group col-sm btn-sm"> 
                <label for="subCategoria">{{ __('SubCategoria') }} </label>
                <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-list"></i></span>
                </div>
                <input type="text" class="form-control" name="subCategoria"  value="{{ $subCategoria->subcategoria }}">
                </div>
            </div>
            <div class="form-group col-sm btn-sm"> 
                <label for="descripcion">{{ __('Descripción') }} </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                    </div>
                    <input type="text" class="form-control" name="descripcion" value="{{ $subCategoria->descripcion }}">
                </div>
            </div>
        </div>
        <div class="row">
          <div class="form-group col-sm btn-sm" >
            <a href="{{ route('subCategoria.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
          </div>
          <div class="form-group col-sm btn-sm">
            <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'subCategoriaUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar') }}</button>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
@endcan
@endsection
