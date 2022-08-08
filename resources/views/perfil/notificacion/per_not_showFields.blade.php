<span class="float-right text-muted text-sm">
  {{ $notificacion->created_at }} 
  ({{ $notificacion->created_at->diffForHumans() }})
</span>
<h6>
  {{ __('De') }}: {{ $notificacion->created_at_not }}<br>
  {{ __('Para') }}: {{ Auth::user()->email }}
</h6>
<h6 class="text-muted text-sm">{{ __('Asunto') }}: {{ $notificacion->asunt }}</h6>
<hr>
{!! Form::textarea('diseño_de_la_notificacion', $notificacion->dis_de_la_notif, ['class' => 'form-control textarea disabled', 'readonly' => 'readonly']) !!}
<div class="row">
  <div class="form-group col-sm btn-sm">
    <center><a href="{{ route('perfil.notificacion.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a></center>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_summernote')
@section('js1')
<script>
  $('.textarea').summernote('disable');
</script>
@endsection