@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' =>  Sistema::datos()->sistemaFindOrFail()->pag])
            {{ Sistema::datos()->sistemaFindOrFail()->emp_abrev }}
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
        {{ Sistema::datos()->sistemaFindOrFail()->emp_abrev }} - Copyright © {{ config('app.year_de_inicio') }} - {{ date('Y') }}. @lang('Todos los derechos reservados.')
        @endcomponent
    @endslot
@endcomponent
