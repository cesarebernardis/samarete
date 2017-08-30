@extends('layouts.app')
@section('styles')
<link href="{{ asset('css/eventi/view.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row margin-bottom-20">
        <div class="col-md-6 text-align-center logo">
            <img src="{{ empty($evento->logo_base64) ? '/public/img/no-image-available.png' : $evento->logo_base64 }}"/>
        </div>
        <div class="col-md-6">
            <h2>{{ $evento->nome }}</h2>
            <div class="oggetto well">{{ $evento->oggetto }}</div>
            @can('edit', $evento)
                <div class="inline"><a href="/eventi/edit-evento?id={{ $evento->id }}" id="modifica" class="btn btn-success">Modifica</a></div>
            @endcan
            @can('delete', $evento)
                <div class="inline"><a href="#" id="elimina" class="btn btn-danger inline">Elimina</a></div>
            @endcan
        </div>
    </div><div class="row">
        <div class="col-md-12">
        <div class="well">
            {{ $evento->descrizione }}
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

var eventi = [
    @foreach($evento->giorni as $giorno)
       {
          title  : "{{ $evento->nome }}",
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
        @if(!empty($evento->giorni))
        defaultDate: "{{ $evento->giorni[0]->giorno.'T'.$evento->giorni[0]->da }}",
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
        events: eventi,
        viewRender: function( view, element ){
            $('#calendar .fc-scroller').attr("style", "overflow-x: hidden; overflow-y: auto; height: auto;");
        },
        windowResize: function( view, element ){
            $('#calendar .fc-scroller').attr("style", "overflow-x: hidden; overflow-y: auto; height: auto;");
        },
    });
    
    $("#elimina").click(function(){
        swal({
          title: 'Sei sicuro di voler eliminare questo evento?',
          text: "Questa azione non è reversibile!",
          type: 'warning',
          showCancelButton: true,
        }).then(function () {
          $.ajax({
               url: '/eventi/delete-evento',
               method: "post",
               data: {id: {{ $evento->id}} },
               success: function(data) {
                    swal({title:"Fatto!", text:"Evento eliminato con successo", type:"success", onClose: function(){window.location.href = "/eventi/view-evento?id="+data.eventoid;}});
               },
               error: function() {
                   swal("Errore!", "Errore durante l'eliminazione dell'evento", "error");
               }
              });
        });
    });
});
</script>
@endsection