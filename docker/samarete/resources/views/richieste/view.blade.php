@extends('layouts.default')

@section('styles')
<link href="{{ asset('css/richieste/view.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="well col-md-12">
                <a href="/richieste/view?id={{ $richiesta->id }}"><h4 class="title">{{ $richiesta->oggetto }}</h4></a>
                <div class="contacts">Contatti: {{ $richiesta->contatto_1.(empty($richiesta->contatto_2) ? '' : ', '.$richiesta->contatto_2) }}</div>
                <div class="text"><p>{{ $richiesta->testo }}</p></div>
                <div class="col-md-12 commands">
                    <div class="date col-md-6"><span>{{ $richiesta->data_creazione }}</span></div>
                    <div class="col-md-6 text-align-right"><button class="btn btn-primary" id="evadi" data-id="{{ $richiesta->id }}">Evadi</button></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">

$(document).ready(function() {
    
    $('div#main_navigation_container ul#main_menu li#menu-item-richieste-new').addClass('active current-menu-parent');
    
    $("button#evadi").click(function(){
        var data = $(this).attr('data-id');
        $.ajax({
           url: '/richieste/evadi-richiesta',
           method: "post",
           data: {id: data},
           success: function(data) {
               swal({title:"Fatto!", text:"Richiesta evasa", type:"success", onClose: function(){window.location.href = "/richieste";}});
           },
           error: function() {
               swal("Errore!", "Errore durante l'evasione della richiesta", "error");
           }
       });
    });
});

</script>
@endsection