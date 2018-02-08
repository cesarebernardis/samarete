@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/associazioni/index.css') }}" rel="stylesheet">
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
    @if (empty($associazioni))
        <h2>Nessun associazione trovato</h2>
    @else
        @foreach ($associazioni as $associazione)
            <div class="col-md-4">
                <div class="well item">
                    <div class="thumbnail">
                        <a href="/associazioni/view-associazione?id={{ $associazione->id }}"><img src="{{ empty($associazione->logo_base64) ? asset('img/no-image-available.png') : $associazione->logo_base64 }}"/></a>
                    </div>
                    <a href="/associazioni/view-associazione?id={{ $associazione->id }}"><h4 class="title">{{ $associazione->nome }}</h4></a>
                    <h6>{{ $associazione->email }}</h6>
                    <h6>{{ $associazione->sito_web }}</h6>
                    <h6>{{ $associazione->telefono1 }}</h6>
                    <h6>{{ $associazione->indirizzo }}</h6>
                </div>
            </div>
        @endforeach
    @endif
    </div>
    @can('create', Samarete\Models\Associazione::class)
    <div class="row">
        <div class="col-md-12">
            <a href="/associazioni/edit-associazione"><button class="btn btn-primary">Crea nuova associazione</button></a>
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
        window.location.replace("/associazioni/?search="+query);
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