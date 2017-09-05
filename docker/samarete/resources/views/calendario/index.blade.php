@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/calendario/index.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="container">
    <div class="row margin-bottom-20 border-bottom-thin">
        <div class="col-md-12 text-align-center"><h2 class="title">Calendario</h2></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="calendar">
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">

var eventi = [
    @foreach($eventi as $evento)
        @foreach($evento->giorni as $giorno)
           {
              title  : "{{ $evento->nome }} - {{ $giorno->descrizione }}",
              start  : "{{ $giorno->giorno.'T'.$giorno->da }}",
              end    : "{{ $giorno->giorno.'T'.$giorno->a }}",
              color  : '#2196F3',
              allDay : false,
           },
        @endforeach
    @endforeach
];

var servizi = [
    @foreach($servizi as $servizio)
        @foreach($servizio->giorni as $giorno)
           {
              title  : "{{ $servizio->nome }} - {{ $giorno->descrizione }}",
              start  : "{{ $giorno->giorno.'T'.$giorno->da }}",
              end    : "{{ $giorno->giorno.'T'.$giorno->a }}",
              color  : '#4CAF50',
              allDay : false,
           },
        @endforeach
    @endforeach
];

$(document).ready(function() {
    
    $('#calendar').fullCalendar({
        defaultView: 'month',
        defaultDate: moment(),
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
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
    
});
</script>
@endsection