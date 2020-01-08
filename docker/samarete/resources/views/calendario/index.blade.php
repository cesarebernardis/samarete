@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/calendario/index.css') }}" rel="stylesheet" />
@endsection

@section('content')
        <section id="titlebar" class="titlebar titlebar-type-solid border-yes titlebar-scheme-light titlebar-alignment-center titlebar-valignment-center titlebar-size-large enable-hr-yes" data-height="350" data-rs-height="yes">
            <div class="parallax-image parallax-section-no" style="background-image: url('{{ asset('img/calendario/header.jpg') }}');"></div>
            <div class="section-overlay"></div>
            <div class="titlebar-wrapper" style="height: 350px; min-height: 350px;">
                <div class="titlebar-content">
                    <div class="container">
                        <div class="row-fluid">
                            <div class="row-fluid">
                                <div class="titlebar-heading">
                                    <h1><span>CALENDARIO</span></h1>
                                    <div class="hr hr-border-primary double-border border-small">
                                        <span></span>
                                    </div>
                                    <div class="titlebar-subcontent">
                                        Qui puoi consultare tutti gli eventi futuri e passati<br/>
                                        proposti dalla nostra comunità
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="section_1737668853" class="section content-box section-border-no section-bborder-no section-height-content section-bgtype-image section-fixed-background-no section-bgstyle-stretch section-triangle-no triangle-location-top parallax-section-no section-overlay-no section-overlay-dot-no " data-video-ratio="" data-parallax-speed="1">
            <div class="section-overlay" style=""></div>
            <div class="container section-content">
                <div class="row">
                    <div class="col-md-12">
                        <div id="calendar">
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

@section('scripts')
<script type="text/javascript">

$(document).ready(function() {
    
    $('div#main_navigation_container ul#main_menu li#menu-item-calendario').addClass('active current-menu-parent');
    
    $('#calendar').fullCalendar({
        defaultView: 'month',
        defaultDate: moment(),
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek'
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
                color  : '#f1c40f',
                allDay : false,
            },{
                url: '/calendario/get-servizi',
                type: 'GET',
                data: {},
                error: function() {
                    swal("Errore!", "Errore durante il caricamento del calendario", "error");
                },
                color  : '#696969',
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