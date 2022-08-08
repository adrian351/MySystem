@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar marca').' '.$marca->marca)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar registro') }}: </strong>
      
        {{ $marca->marca}}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}"> 
      <small>{{ $marca->id }}</small>
    </div>
  </div>
</div>
@can('marca.edit')
<div class="card card-outline card-tabs position-relative bg-white">
    <div class="card-body">
        {!! Form::open(['route' => ['marca.update', Crypt::encrypt($marca->id)], 'method' => 'patch', 'id' => 'marcaUpdate']) !!}
            <div class="row">
                <div class="form-group col-sm btn-sm">
                    <label for="marca">{{ __('Marca') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-tag"></i></span>
                        </div>
                        <input type="text" class="form-control" id="marca" name="marca" placeholder="{{ __('Marca') }}" value="{{ old('marca', $marca->marca) }}">
                    </div>
                </div>
                <div class="form-group col-sm btn-sm">
                    <label for="razon_social">{{ __('Razón Social') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                        </div>
                        <input type="text" class="form-control" id="razon_social" name="razon_social" placeholder="{{ __('Razón Social') }}" value="{{ old('marca', $marca->razon_social) }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm btn-sm">
                    <label for="dominio">{{ __('Dominio') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-globe"></i></span>
                        </div>
                        @if(count($marca->dominio)>0)
                            @foreach ($marca->dominio as $dom)
                                @if ($dom->dominio !== null)
                                    <input type="text" class="form-control"  name="dominio" placeholder="{{ __('Dominio') }}" value="{{ old('marca', $dom->dominio)}}">  
                                    <input type="hidden" class="form-control"  name="dominio_id" value="{{ old('marca', $dom->id)}}">        
                                @endif
                            @endforeach
                            @else
                            <input type="text" class="form-control" name="dominio" placeholder="{{ __('Dominio') }}" value="">  
                            <input type="hidden" class="form-control"  name="dominio_id" value="0">             
                        @endif
                    </div>
                </div>
                <div class="form-group col-sm btn-sm">
                    <label for="email">{{ __('Email') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        @if(count($marca->email)>0)
                            @foreach ($marca->email as $correo)
                                @if ($correo->email !== null)
                                    <input type="text" class="form-control"  name="email" placeholder="{{ _('Email') }}" value="{{ old('marca', $correo->email)}}">   
                                    <input type="hidden" class="form-control"  name="email_id" value="{{ old('marca', $correo->id)}}">          
                                @endif       
                            @endforeach
                            @else
                                <input type="text" class="form-control" name="email" aria-describedby="" placeholder="{{ __('Email') }}" value="">  
                                <input type="hidden" class="form-control"  name="email_id" aria-describedby="" placeholder="{{ __('Email') }}" value="0">      
                        @endif
                    </div>
                </div>
            </div>

            @if (count ($marca->telefono)==0)
                <div class="row">  
                    <div class="form-group col-sm btn-sm">
                        <label for="telefono">{{ __('Teléfono') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" class="form-control"  name="telefono" placeholder="{{ __('Teléfono') }}" value="">
                            <input type="hidden" class="form-control"  name="telefono_id" value="0">
                        </div>
                    </div>
                    <div class="form-group col-sm btn-sm">
                        <label for="whats_app">{{ __('Whats App') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                            </div>
                            <input type="text" class="form-control"  name="whats_app"  placeholder="{{ __('Whats App') }}" value="">
                            <input type="hidden" class="form-control"  name="whats_app_id" value="0">
                        </div>
                    </div> 
                </div>
                @else  
                    <div class="row"> 
                        <div class="form-group col-sm btn-sm">
                            <label for="telefono">{{ __('Teléfono') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                @if($marca->telefono()->where('tipo','local')->first())
                                    <input type="text" class="form-control"  name="telefono" placeholder="Teléfono" value="{{$marca->telefono()->where('tipo','local')->first()->telefono}}">
                                    <input type="hidden" class="form-control" name="telefono_id" value="{{$marca->telefono()->where('tipo','local')->first()->id}}">
                                    @else
                                        <input type="text" class="form-control"  name="telefono"  placeholder="{{ __('Teléfono') }}" value="">
                                        <input type="hidden" class="form-control"  name="telefono_id" value="0">
                                @endif
                            </div>
                        </div> 
                        <div class="form-group col-sm btn-sm">
                            <label for="whats_app">{{ __('Whats App') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                </div>
                                @if($marca->telefono()->where('tipo','whats_app')->first())
                                    <input type="text" class="form-control"  name="whats_app" placeholder="Teléfono" value="{{$marca->telefono()->where('tipo','whats_app')->first()->telefono}}">
                                    <input type="hidden" class="form-control"  name="whats_app_id" value="{{$marca->telefono()->where('tipo','whats_app')->first()->id}}">
                                    @else
                                        <input type="text" class="form-control"  name="whats_app" placeholder="{{ __('Whats App') }}" value="">
                                        <input type="hidden" class="form-control"  name="whats_app_id" value="0">
                                @endif
                            </div>
                        </div> 
                    </div>
            @endif
            <div class="row">
                <div class="form-group col-sm btn-sm">
                    <label for="coment">{{ __('Comentarios') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-text-width"></i></span>
                        </div>
                        <textarea class="form-control" type="text" id="coment" name="coment"  value="{{ old('marca', $marca->coment) }}">{{ $marca->coment }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm btn-sm" >
                    <a href="{{ route('marca.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
                </div>
            <div class="form-group col-sm btn-sm">
                <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'marcaUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar') }}</button>
            </div>
        </div>
      {!! Form::close() !!}
    </div>
</div>
@endcan
@endsection