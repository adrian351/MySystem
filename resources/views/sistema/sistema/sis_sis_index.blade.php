@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', Sistema::datos()->sistemaFindOrFail()->emp_abrev)</title>
<div class="card">
  @include('sistema.sis_menu')
  <div class="card-body">
    {!! Form::model(Sistema::datos(), ['route' => ['sistema.update'], 'method' => 'patch', 'id' => 'sistemaUpdate', 'files' => true]) !!}
      @include('sistema.sistema.sis_sis_editFieldsEmpresa')
      @include('sistema.sistema.sis_sis_editFieldsDirecciones')
      @include('sistema.sistema.sis_sis_editFieldsCorreos')
      @include('sistema.sistema.sis_sis_editFieldsRedesSociales')
      @include('sistema.sistema.sis_sis_editFieldsSeries')
      @include('sistema.sistema.sis_sis_editFieldsPlantillas')
      @include('sistema.sistema.sis_sis_editFieldsImagenes')
      <hr>
      <div class="row">
        <div class="form-group col-sm btn-sm">
          <center><button type="submit" id="btnsubmit2" class="btn btn-info w-50 p-2" onclick="return check('btnsubmit2', 'sistemaUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar la información del sistema?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar') }}</button></center>
        </div>
      </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection
@include('layouts.private.plugins.priv_plu_select2')