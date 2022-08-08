<div class="card card-primary">
  <div class="card-body box-profile">
    <div class="text-center">
    @if(Auth::user()->img_us != null)
      <img src="{{ Auth::user()->img_us_rut . Auth::user()->img_us }}" class="profile-user-img img-fluid img-circle"  alt="{{ Sistema::datos()->sistemaFindOrFail()->defau_img_perf }}">
    @else
      <img src="{{ Sistema::datos()->sistemaFindOrFail()->defau_img_perf_rut . Sistema::datos()->sistemaFindOrFail()->defau_img_perf }}" class="profile-user-img img-fluid img-circle"  alt="{{ Sistema::datos()->sistemaFindOrFail()->defau_img_perf }}">
    @endif
    </div>
    <h3 class="profile-username text-center">{{ Auth::user()->nom . ' ' . Auth::user()->apell }}</h3>
    <p class="text-muted text-center">
      {{-- {{ Auth::user()->getRoleNom()->implode(', ') }} --}}
      @foreach (Auth::user()->roles as $rol)
        @if ($rol->nom >= 1)
          {{ $rol->nom.", " }}
          @else
            {{ $rol->nom }}
        @endif
      @endforeach
      <br> <!-- Funcion declarada en Spatie\Permission\Traits\HasRole -->
      {{ Auth::user()->email }}<br>
      {{ __('Fecha de registro') }} {{ Auth::user()->created_at->isoFormat('lll') }}<br>
      {{ __('Último inicio de sesión') }} {{ Auth::user()->last_login }}<br>
    </p>
    <strong><i class="fas fa-envelope mr-1"></i> {{ __('Correo de registro') }} </strong>
    <p class="text-muted">{{ Auth::user()->email_registro }}</p>
    <hr>
    <strong><i class="fas fa-envelope mr-1"></i> {{ __('Correo secundario') }}</strong>
    <p class="text-muted">{{ Auth::user()->email_secund }}</p>
    <hr>
    <strong><i class="fas fa-tty mr-1"></i> {{ __('Teléfono fijo') }}</strong>
    <p class="text-muted">
      @if(Auth::user()->tel_fij != null)({{ Auth::user()->lad_fij }}) {{ Auth::user()->tel_fij }}@endif
      @if(Auth::user()->ext != null){{ __('Extensión') }}  {{ Auth::user()->ext }}@endif
    </p>
    <hr>
    <strong><i class="fas fa-mobile-alt mr-1"></i> {{ __('Teléfono móvil') }}</strong>
    <p class="text-muted">({{ Auth::user()->lad_mov }}) {{ Auth::user()->tel_mov }}</p>
    <hr>
    <strong><i class="far fa-building mr-1"></i> {{ __('Empresa') }}</strong>
    <p class="text-muted">{{ Auth::user()->emp }}</p>
  </div>
</div>