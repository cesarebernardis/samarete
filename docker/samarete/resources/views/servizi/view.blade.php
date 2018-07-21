@extends('layouts.default')
@section('styles')
<link href="{{ asset('css/servizi/view.css?v='.time()) }}" rel="stylesheet">
@endsection

@section('content')
    <section id="section_589096598" class="section content-box section-border-no section-bborder-no section-height-content section-bgtype-image section-fixed-background-no section-bgstyle-stretch section-triangle-no triangle-location-top parallax-section-no section-overlay-no section-overlay-dot-no ">
        <div class="section-overlay" style=""></div>
        <div class="container section-content">
            <div class="row-fluid">
                <div class="row-fluid equal-cheight-no element-padding-large element-vpadding-medium">
                    <div class="section-column span6" style="margin-bottom: 0px;">
                        <div class="inner-content content-box textnone" style="padding:0px;">
                            <h2 class="title textleft default bw-2px dh-2px divider-dark bc-dark dw-default color-default" style="margin-bottom:0px">
                                <span>{{ $servizio->nome }}</span>
                            </h2>
                            <div class="hr border-small dh-2px alignleft hr-border-primary">
                                <span></span>
                            </div>
                            <h4 class="title textleft default bw-2px dh-2px divider-dark bc-dark dw-default color-default" style="margin-bottom:0px">
                                <span>Oggetto</span>
                            </h4>
                            <div class="inner-content content-box textnone" style="padding:0px;">
                                <div class="column-text ">{{ $servizio->oggetto }}</div>
                            </div>
                        <div class="col-md-12 text-align-center margin-top-10">
                            @can('update', $servizio)
                                <div class="inline">
                                <a id="modifica" class="button button_default button_color_default button_default border-radius-default icon-align-left" title="Modifica" href="/servizi/edit-servizio?id={{ $servizio->id }}"><span>Modifica</span></a>
                                </div>
                            @endcan
                            @can('delete', $servizio)
                                <div class="inline">
                                <a id="elimina" class="button button_default button_color_black button_default border-radius-default icon-align-left" title="Elimina" href="#"><span>Elimina</span></a>
                                </div>
                            @endcan
                        </div>
                        </div>
                    </div>
                    <div class="section-column span6" style="margin-bottom: 0px;">
                        <div class="inner-content content-box textnone" style="padding:0px;">
                            <div class="single-image-container img-align-center ">
                                <div class="single-image" >
                                    <img src="{{ empty($servizio->categoria->icona) ? '/public/img/no-image-available.png' : '/public/img/catservizi/'.$servizio->categoria->icona }}" class="attachment-full" alt="{{ $servizio->nome }}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="section content-box section-border-no section-bborder-no section-height-content section-bgtype-image section-fixed-background-no section-bgstyle-stretch section-triangle-no triangle-location-top parallax-section-no section-overlay-no section-overlay-dot-no " data-video-ratio="" data-parallax-speed="1">
        <div class="section-overlay" style=""></div>
        <div class="container section-content">
            <div class="row-fluid">
                <div class="row-fluid equal-cheight-no element-padding-medium element-vpadding-medium">
                    <div class="section-column span12" style="">
                        <div class="inner-content content-box textnone" style="padding:0px;">
                            <div class="column-text ">{!! $servizio->descrizione !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section id="section_913510768" class="section content-box full-width section-border-no section-bborder-no section-height-content section-bgtype-image section-fixed-background-no section-bgstyle-stretch section-triangle-no triangle-location-top parallax-section-no section-overlay-no section-overlay-dot-no " style="padding-top:0;padding-bottom:0;background-color:#ffffff;" data-video-ratio="" data-parallax-speed="1">
        <div class="section-overlay" style=""></div>
        <div class="container section-content">
            <div class="row-fluid">
                <div class="row-fluid equal-cheight-no element-padding-medium element-vpadding-medium">
                    <div class="section-column span12" style="">
                        <div class="inner-content content-box textnone" style="padding:0px;">
                            <div class="static-content maps-style">
                                <div id="google_map" style="width: 100%; height: 450px; position: relative; overflow: hidden;">
                                    <div style="height: 100%; width: 100%; position: absolute; top: 0px; left: 0px; background-color: rgb(229, 227, 223);">
                                        <div class="gm-err-container">
                                            <div class="gm-err-content">
                                                <div class="gm-err-icon"><img src="http://maps.gstatic.com/mapfiles/api-3/images/icon_error.png" draggable="false" style="user-select: none;"></div>
                                                <div class="gm-err-title">Spiacenti, si è verificato un problema.</div>
                                                <div class="gm-err-message">Google Maps non è stata caricata correttamente. Contatta un amministratore.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- map container -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
    <div class="row">
        <div class="col-md-12">
            <div class="" id="calendar">
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">

var map;
var marker;

function initializeMaps() {

    map = new google.maps.Map(document.getElementById('google_map'), {
        center: new google.maps.LatLng(SAMARATE_LAT, SAMARATE_LNG),
        zoom: 15,
    });
    
    var luogo = "{{ $servizio->luogo }}";
    if(luogo){
        $.ajax({
            url: 'https://maps.googleapis.com/maps/api/geocode/json',
            method: "get",
            data: {
                address: luogo,
                key: "AIzaSyDSJfzYCSKO-kTf-gLXq8ROrpFVh3SLQ3Y",
            },
            crossDomain: true,
            success: function(data) {
                if(data.status == "OK"){
                    var place = data.results[0];
                    if(place.geometry){
                        marker = new google.maps.Marker({
                            map: map,
                            position: place.geometry.location
                        });
                        if (place.geometry.viewport) {
                          map.fitBounds(place.geometry.viewport);
                        } else {
                          map.setCenter(place.geometry.location);
                          map.setZoom(15);
                        }
                    }
                }else{
                    swal("Errore!", "Errore durante il caricamento della mappa", "error");
                }
            },
            error: function(err) {
                swal("Errore!", "Errore durante il caricamento della mappa 2", "error");
            }
        });
    }

}

$(document).ready(function() {
    
    $('div#main_navigation_container ul#main_menu li#menu-item-servizi').addClass('active current-menu-parent');
    
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
        events: {
            url: '/servizi/get-calendar',
            type: 'GET',
            data: {
                id: {{ $servizio->id }},
            },
            error: function() {
                swal("Errore!", "Errore durante il caricamento del calendario", "error");
            },
            color  : '#C2185B',
            allDay : false,
        },
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
                    swal({title:"Fatto!", text:"Servizio eliminato con successo", type:"success", onClose: function(){window.location.href = "/servizi"}});
               },
               error: function() {
                   swal("Errore!", "Errore durante l'eliminazione del servizio", "error");
               }
           });
        });
    });
});
</script>
@endsection