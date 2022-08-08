@extends('perfil.perfil.per_per_index')
@section('contenidoPerfil')
{!! Form::open(['route' => 'perfil.update', 'method' => 'patch', 'id' => 'perfilUpdate', 'files' => true]) !!}
  @include('perfil.perfil.editar.per_per_editFields')
{!! Form::close() !!}
@endsection

@section('css')
<style>
  .input{
    border-radius: 20px;
    background:rgb(255, 255, 255);
    box-shadow: inset 4px 4px 6px -1px rgba(206, 206, 206, 0.13),
                inset -4px -4px 6px -1px rgba(255,255,255,0.7),
                -0.5px -0.5px 0 rgb(255, 255, 255),
                0.5px 0.5px 0 rgba(0,0,0,0.15),
                0px 12px 10px -10px rgba(0,0,0,0.05);
    border: 1px solid rgba(0,0,0,0.01);
  }
  .ci{
    color: rgb(7, 7, 7);
    box-shadow: inset 4px 4px 6px -1px rgba(0,0,0,0.2),
                inset -4px -4px 6px -1px rgba(255,255,255,0.7),
                -0.5px -0.5px 0 rgba(255,255,255,1),
                0.5px 0.5px 0 rgba(0,0,0,0.15),
                0px 12px 10px -10px rgba(0,0,0,0.05);
    border: 1px solid rgba(0,0,0,0.01);
    
  }

  .btn_perfil{
    display: flex;
    align-items: center;
    justify-content: center;
    list-style: none;
    text-align: center;
    font-size: 15px;
    color: black;
    padding: 5px 0;
    margin-right: 5px;
    border-radius: 20px;
    background:rgb(127, 229, 247);
    box-shadow: inset 4px 4px 6px -1px rgba(0, 0, 0, 0.2),
                inset -4px -4px 6px -1px rgba(255, 255, 255, 0.7),
                -0.5px -0.5px 0 rgb(171, 193, 241),
                0.5px 0.5px 0 rgba(0,0,0,0.15),
                0px 12px 10px -10px rgba(0,0,0,0.05);
    border: 1px solid rgba(0,0,0,0.01);
  
  }

  {{--  .campo{
    display: flex;
    justify-content: center;
    border-radius: 10px;
    box-shadow: inset 4px 4px 6px -1px rgba(0,0,0,0.2),
                inset -4px -4px 6px -1px rgba(255,255,255,0.7),
                -0.5px -0.5px 0 rgba(255,255,255,1),
                0.5px 0.5px 0 rgba(0,0,0,0.15),
                0px 12px 10px -10px rgba(0,0,0,0.05);
    border: 1px solid rgba(0,0,0,0.01);
  }  --}}
</style>
@endsection