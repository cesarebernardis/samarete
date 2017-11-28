@extends('layouts.app')
@section('styles')
<link href="{{ asset('css/servizi/view.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row margin-bottom-20">
        <div class="col-md-6 text-align-center logo">
            <img src="{{ empty($servizio->logo_base64) ? '/public/img/no-image-available.png' : $servizio->logo_base64 }}"/>
        </div>
        <div class="col-md-6">
            <h2>{{ $servizio->nome }}</h2>
            <div class="oggetto well">{{ $servizio->oggetto }}</div>
            @can('update', $servizio)
                <div class="inline"><a href="/servizi/edit-servizio?id={{ $servizio->id }}" id="modifica" class="btn btn-success">Modifica</a></div>
            @endcan
            @can('delete', $servizio)
                <div class="inline"><a href="#" id="elimina" class="btn btn-danger inline">Elimina</a></div>
            @endcan
        </div>
    </div><div class="row">
        <div class="col-md-12">
        <div class="well">
            {!! $servizio->descrizione !!}
        </div>
        </div>
    </div><div class="row">
        <div class="col-md-12">
            <div class="" id="calendar">
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">

var servizi = [
    @foreach($servizio->giorni as $giorno)
       {
          title  : "{{ $servizio->nome }} - {{ $giorno->descrizione }}",
          start  : "{{ $giorno->giorno.'T'.$giorno->da }}",
          end    : "{{ $giorno->giorno.'T'.$giorno->a }}",
          color  : '#C2185B',
          allDay : false,
       },
    @endforeach
];

$(document).ready(function() {
    $('#calendar').fullCalendar({
        defaultView: 'listWeek',
        @if(!empty($servizio->giorni))
        defaultDate: "{{ $servizio->giorni[0]->giorno.'T'.$servizio->giorni[0]->da }}",
        @endif
        header: {
            left:   'title',
            center: '',
            right:  'prev,next'
        },
        height: 'auto',
        contentHeight: 'auto',
        timeFormat: 'HH:mm',
        locale: 'it',
        timezone: 'local',
        events: servizi,
        viewRender: function( view, element ){
            $('#calendar .fc-scroller').attr("style", "overflow-x: hidden; overflow-y: auto; height: auto;");
        },
        windowResize: function( view, element ){
            $('#calendar .fc-scroller').attr("style", "overflow-x: hidden; overflow-y: auto; height: auto;");
        },
    });
    
    $("#elimina").click(function(){
        swal({
          title: 'Sei sicuro di voler eliminare questo servizio?',
          text: "Questa azione non è reversibile!",
          type: 'warning',
          showCancelButton: true,
        }).then(function () {
          $.ajax({
               url: '/servizi/delete-servizio',
               method: "post",
               data: {id: {{ $servizio->id}} },
               success: function(data) {
                    swal({title:"Fatto!", text:"Servizio eliminato con successo", type:"success", onClose: function(){window.location.href = "/servizi/view-servizio?id="+data.servizioid;}});
               },
               error: function() {
                   swal("Errore!", "Errore durante l'eliminazione dell'servizio", "error");
               }
              });
        });
    });
});
</script>
@endsection