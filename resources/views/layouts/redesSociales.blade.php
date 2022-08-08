<p class="text-right text-muted"> {{ __('Visita nuestras redes sociales') }}</p>
<div class="row justify-content-center">
  <div class="form-group">
    <div class="input-group">
      @if(Sistema::datos()->sistemaFindOrFail()->red_fbk != null)
        <a class="r btn btn-link rounded-circle border m-1" href="{{ Sistema::datos()->sistemaFindOrFail()->red_fbk }}" target="_blank" title="{{ Sistema::datos()->sistemaFindOrFail()->red_fbk }}"><i class="fab fa-facebook"></i></a>
      @endif
      @if(Sistema::datos()->sistemaFindOrFail()->red_tw != null)
        <a class="r btn btn-link rounded-circle border m-1" href="{{ Sistema::datos()->sistemaFindOrFail()->red_tw }}" target="_blank" title="{{ Sistema::datos()->sistemaFindOrFail()->red_tw }}"><i class="fab fa-twitter-square"></i></a>
      @endif
      @if(Sistema::datos()->sistemaFindOrFail()->red_ins != null)
        <a class="r btn btn-link rounded-circle border m-1" href="{{ Sistema::datos()->sistemaFindOrFail()->red_ins }}" target="_blank" title="{{ Sistema::datos()->sistemaFindOrFail()->red_ins }}"><i class="fab fa-instagram"></i></a>
      @endif
      @if(Sistema::datos()->sistemaFindOrFail()->red_link != null)
        <a class="r btn btn-link rounded-circle border m-1" href="{{ Sistema::datos()->sistemaFindOrFail()->red_link }}" target="_blank" title="{{ Sistema::datos()->sistemaFindOrFail()->red_link }}"><i class="fab fa-linkedin"></i></a>
      @endif
      @if(Sistema::datos()->sistemaFindOrFail()->red_youtube != null)
        <a class="r btn btn-link rounded-circle border m-1" href="{{ Sistema::datos()->sistemaFindOrFail()->red_youtube }}" target="_blank" title="{{ Sistema::datos()->sistemaFindOrFail()->red_youtube }}"><i class="fab fa-youtube"></i></a>
      @endif
    </div>
  </div>
</div>