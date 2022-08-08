@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registrar SubCategoria'))</title>
<div class="card">
    <div class="card-header p-1">
        <ul class="nav nav-pills">
          @include('subCategoria.subCat_menu')
        </ul>
    </div>
    <div class="card-body">
      {!! Form::open(['route' => 'subCategoria.store', 'onsubmit' => 'return checarBotonSubmit("btnsubmit")']) !!}
        <div class="row">
          <div class="form-group col-sm btn-sm"> 
            <label for="categoria">{{ __('Categoría') }} </label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-level-up-alt"></i></span>
              </div>
              <select class="form-control select2" aria-label="Default select example" placeholder="selecciona"  name="categoria[]" >
                <option></option>
                @foreach ($categoria_list as $categoria )
                <option value="{{ $categoria->id }}">{{ $categoria->categoria}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group col-sm btn-sm"> 
            <label for="subCategoria">{{ __('SubCategoria') }} </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-list"></i></span>
                </div>
                <input type="text" class="form-control"  name="subCategoria"  placeholder="{{ __('SubCategoria') }}" required>
              </div>
          </div>
          <div class="form-group col-sm btn-sm"> 
            <label for="descripcion">{{ __('Descripción') }} </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                </div>
                <input type="text" class="form-control" name="descripcion"  placeholder="{{ __('Descripción') }}">
              </div>
            </div>
        </div>
        <div class="row">
          <div class="form-group col-sm btn-sm">
            <a href="{{ route('subCategoria.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
          </div>
          <div class="form-group col-sm btn-sm">
            <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Registrar') }}</button>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
</div>
@endsection