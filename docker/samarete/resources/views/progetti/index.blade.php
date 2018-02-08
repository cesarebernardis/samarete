@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/progetti/index.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row margin-bottom-20">
        <div class="left col-md-8"></div>
        <div class="left col-md-4 col-xs-12">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" placeholder="Cerca..." id="query-cerca" size="50" maxlength="50" value="{{ empty($query) ? '' : $query }}"/>
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button" id="submit-cerca">
                    <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </div>
    </div>
    <div class="row itemlist">
    @if (empty($progetti))
        <h2>Nessun progetto trovato</h2>
    @else
        @foreach ($progetti as $progetto)
            <div class="col-md-4">
                <div class="well item">
                    <div class="thumbnail"><a href="/progetti/view-progetto?id={{ $progetto->id }}"><img src="{{ empty($progetto->logo_base64) ? asset('img/no-image-available.png') : $progetto->logo_base64 }}"/></a></div>
                    <a href="/progetti/view-progetto?id={{ $progetto->id }}"><h4 class="title">{{ $progetto->nome }}</h4></a>
                    <p class="object">{{ $progetto->oggetto }}</p>
                </div>
            </div>
        @endforeach
    @endif
    </div>
    @can('create', Samarete\Models\Progetto::class)
    <div class="row">
        <div class="col-md-12">
            <a href="/progetti/edit-progetto"><button class="btn btn-primary">Crea nuovo progetto</button></a>
        </div>
    </div>
    @endcan
</div>
@endsection

@section('scripts')
<script type="text/javascript">

$(document).ready(function(){
    
    var originalQuery = "{{ $query }}";
    
    function relocate(){
        var query = $("input#query-cerca").val();
        if(!query && !originalQuery) return;
        window.location.replace("/progetti/?search="+query);
    }
    
    $("button#submit-cerca").click(relocate);
    
    $('input#query-cerca').keypress(function(event) {
        if (event.keyCode == 13 || event.which == 13) {
            relocate();
        }
    });
    
});

</script>
@endsection