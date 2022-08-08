@extends('errors::illustrated-layout')

@section('title', __('Prohibido'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: __('Prohibido')))
@section('image')
<img src="{{ Sistema::datos()->sistemaFindOrFail()->error_rut . Sistema::datos()->sistemaFindOrFail()->error }}">
@endsection