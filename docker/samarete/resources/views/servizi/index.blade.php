@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/servizi/index.css') }}" rel="stylesheet">
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
    @if (empty($servizi))
        <h2>Nessun servizio trovato</h2>
    @else
        @foreach ($servizi as $servizio)
            <div class="col-md-4">
                <div class="well item">
                    <div class="thumbnail">
                        <a href="/servizi/view-servizio?id={{ $servizio->id }}"><img src="{{ empty($servizio->logo_base64) ? '/public/img/no-image-available.png' : $servizio->logo_base64 }}"/></a>
                    </div>
                    <a href="/servizi/view-servizio?id={{ $servizio->id }}"><h4 class="title">{{ $servizio->nome }}</h4></a>
                    <p class="object">{{ $servizio->oggetto }}</p>
                </div>
            </div>
        @endforeach
     @endif
    </div>
    @can('create', Samarete\Models\Servizio::class)
    <div class="row">
        <div class="col-md-12">
            <a href="/servizi/edit-servizio"><button class="btn btn-primary">Crea nuovo servizio</button></a>
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
        window.location.replace("/servizi/?search="+query);
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