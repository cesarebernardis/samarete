@extends('layouts.default')

@section('styles')
<link href="{{ asset('css/richieste/index.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="row itemlist">
    @if (empty($richieste))
        <h2>Nessun richiesta trovata</h2>
    @else
        @foreach ($richieste->sortByDesc('data_creazione') as $richiesta)
            <div class="col-md-6">
                <div class="well item">
                    <a href="/richieste/view?id={{ $richiesta->id }}"><h4 class="title">{{ $richiesta->oggetto }}</h4></a>
                    <div class="contacts">Contatti: {{ $richiesta->contatto_1.(empty($richiesta->contatto_2) ? '' : ', '.$richiesta->contatto_2) }}</div>
                    <div class="date"><span>{{ $richiesta->data_creazione }}</span></div>
                </div>
            </div>
        @endforeach
    @endif
    </div>
@endsection

@section('scripts')
<script type="text/javascript">

$(document).ready(function() {
    
    $('div#main_navigation_container ul#main_menu li#menu-item-richieste-new').addClass('active current-menu-parent');
    
});

</script>
@endsection