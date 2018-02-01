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
        eventSources: [
            {
                url: '/calendario/get-eventi',
                type: 'GET',
                data: {},
                error: function() {
                    swal("Errore!", "Errore durante il caricamento del calendario", "error");
                },
                color  : '#2196F3',
                allDay : false,
            },{
                url: '/calendario/get-servizi',
                type: 'GET',
                data: {},
                error: function() {
                    swal("Errore!", "Errore durante il caricamento del calendario", "error");
                },
                color  : '#4CAF50',
                allDay : false,
            },
        ],
        eventClick: function(event) {
            if (event.url) {
                window.open(event.url);
                return false;
            }
        },
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