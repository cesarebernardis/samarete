@extends('layouts.app')
@section('styles')
<link href="{{ asset('css/associazioni/view.css?v='.time()) }}" rel="stylesheet">
@endsection

@section('content')
<div class="fullwidth">
    <section id="section_589096598" class="section content-box section-border-no section-bborder-no section-height-content section-bgtype-image section-fixed-background-no section-bgstyle-stretch section-triangle-no triangle-location-top parallax-section-no section-overlay-no section-overlay-dot-no ">
        <div class="section-overlay" style="">
        </div>
        <div class="container section-content">
            <div class="row-fluid">
                <div class="row-fluid equal-cheight-no element-padding-large element-vpadding-medium">
                    <div class="section-column span6" style="">
                        <div class="inner-content content-box textnone" style="padding:0px;">
                            <div class="single-image-container img-align-none ">
                                <div class="single-image" >
                                    <img src="{{ empty($associazione->logo_base64) ? '/public/img/no-image-available.png' : $associazione->logo_base64 }}" class="attachment-full" alt="{{ $associazione->nome }}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-column span6" style="">
                        <div class="inner-content content-box textnone" style="padding:0px;">
                            <h2 class="title textleft default bw-2px dh-2px divider-dark bc-dark dw-default color-default" style="margin-bottom:0px">
                                <span>{{ $associazione->nome }}</span>
                            </h2>
                            <h4 class="title textleft default bw-2px dh-2px divider-dark bc-dark dw-default color-default" style="margin-bottom:0px">
                                <span>{{ $associazione->acronimo }}</span>
                            </h4>
                            <div class="hr border-small dh-2px alignleft hr-border-primary">
                                <span></span>
                            </div>
                            <div class=" info">
                                @if(!empty($associazione->indirizzo))
                                <div class="indirizzo">
                                    <div class="col-md-5 label text-align-right">Indirizzo:</div>
                                    <div class="col-md-7 ">{{ $associazione->indirizzo }}</div>
                                </div>
                                @endif
                                @if(!empty($associazione->telefono_1))
                                <div class="telefono">
                                    <div class="col-md-5 label text-align-right">Telefono:</div>
                                    <div class="col-md-7 ">{{ $associazione->telefono_1.(empty($associazione->telefono_2) ? '' : $associazione->telefono_2) }}</div>
                                </div>
                                @endif
                                @if(!empty($associazione->email))
                                <div class="email">
                                    <div class="col-md-5 label text-align-right">E-Mail:</div>
                                    <div class="col-md-7 ">{{ $associazione->email }}</div>
                                </div>
                                @endif
                                @if(!empty($associazione->sito_web))
                                <div class="sito_web">
                                    <div class="col-md-5 label text-align-right">Sito WEB:</div>
                                    <div class="col-md-7 ">{{ $associazione->sito_web }}</div>
                                </div>
                                @endif
                            </div>
                            <h4 class="title textleft default bw-2px dh-2px divider-dark bc-dark dw-default color-default" style="margin-bottom:0px">
                                <span>Referente</span>
                            </h4>
                            <div class="hr border-small dh-2px alignleft hr-border-primary">
                                <span></span>
                            </div>
                            <div class="referente">
                                <div class="nome">
                                    <div class="col-md-5 label text-align-right">Nome:</div>
                                    <div class="col-md-7 ">{{ $associazione->referente_nome }}</div>
                                </div>
                                @if(!empty($associazione->referente_indirizzo))
                                <div class="indirizzo">
                                    <div class="col-md-5 label text-align-right">Indirizzo:</div>
                                    <div class="col-md-7 ">{{ $associazione->referente_indirizzo }}</div>
                                </div>
                                @endif
                                @if(!empty($associazione->referente_telefono_1))
                                <div class="telefono">
                                    <div class="col-md-5 label text-align-right">Telefono:</div>
                                    <div class="col-md-7 ">{{ $associazione->referente_telefono_1.(empty($associazione->referente_telefono_2) ? '' : $associazione->referente_telefono_2) }}</div>
                                </div>
                                @endif
                            </div>
            <div class="col-md-12 text-align-center">
                @can('update', $associazione)
                    <div class="inline"><a href="/associazioni/edit-associazione?id={{ $associazione->id }}" id="modifica" class="btn btn-success">Modifica</a></div>
                @endcan
                @can('delete', $associazione)
                    <div class="inline"><a href="#" id="elimina" class="btn btn-danger inline">Elimina</a></div>
                @endcan
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
            <div class="row-fluid">
                <div class="row-fluid equal-cheight-no element-padding-medium element-vpadding-medium">
                    <div class="section-column span12" style="">
                        <div class="inner-content content-box textnone" style="padding:0px;">
                            <!-- <h5 class="title textcenter default bw-defaultpx dh-defaultpx divider-dark bc-default dw-default color-default" style="margin-bottom:35px"><span>Highlighted Text</span></h5> -->
                            <div class="column-text ">
                                {!! $associazione->descrizione !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div><!--
<div class="container">
    <div class="row margin-bottom-20">
        <div class="col-md-6 text-align-center logo">
            <img src="{{ empty($associazione->logo_base64) ? '/public/img/no-image-available.png' : $associazione->logo_base64 }}"/>
        </div>
        <div class="col-md-6">
            <div class="col-md-12 info">
                <h2 class="title text-align-center">{{ $associazione->nome }}</h2>
                @if(!empty($associazione->acronimo))
                <h4 class="acronimo text-align-center">{{ $associazione->acronimo }}</h4>
                @endif
                @if(!empty($associazione->indirizzo))
                <div class="indirizzo">
                    <div class="col-md-5 label text-align-right">Indirizzo:</div>
                    <div class="col-md-7 ">{{ $associazione->indirizzo }}</div>
                </div>
                @endif
                @if(!empty($associazione->telefono_1))
                <div class="telefono">
                    <div class="col-md-5 label text-align-right">Telefono:</div>
                    <div class="col-md-7 ">{{ $associazione->telefono_1.(empty($associazione->telefono_2) ? '' : $associazione->telefono_2) }}</div>
                </div>
                @endif
                @if(!empty($associazione->email))
                <div class="email">
                    <div class="col-md-5 label text-align-right">E-Mail:</div>
                    <div class="col-md-7 ">{{ $associazione->email }}</div>
                </div>
                @endif
                @if(!empty($associazione->sito_web))
                <div class="sito_web">
                    <div class="col-md-5 label text-align-right">Sito WEB:</div>
                    <div class="col-md-7 ">{{ $associazione->sito_web }}</div>
                </div>
                @endif
            </div>
            <div class="col-md-12 referente">
                <h4 class="referente text-align-center">Referente</h4>
                <div class="nome">
                    <div class="col-md-5 label text-align-right">Nome:</div>
                    <div class="col-md-7 ">{{ $associazione->referente_nome }}</div>
                </div>
                @if(!empty($associazione->referente_indirizzo))
                <div class="indirizzo">
                    <div class="col-md-5 label text-align-right">Indirizzo:</div>
                    <div class="col-md-7 ">{{ $associazione->referente_indirizzo }}</div>
                </div>
                @endif
                @if(!empty($associazione->referente_telefono_1))
                <div class="telefono">
                    <div class="col-md-5 label text-align-right">Telefono:</div>
                    <div class="col-md-7 ">{{ $associazione->referente_telefono_1.(empty($associazione->referente_telefono_2) ? '' : $associazione->referente_telefono_2) }}</div>
                </div>
                @endif
            </div>
            <div class="col-md-12 text-align-center">
                @can('update', $associazione)
                    <div class="inline"><a href="/associazioni/edit-associazione?id={{ $associazione->id }}" id="modifica" class="btn btn-success">Modifica</a></div>
                @endcan
                @can('delete', $associazione)
                    <div class="inline"><a href="#" id="elimina" class="btn btn-danger inline">Elimina</a></div>
                @endcan
            </div>
        </div>
    </div><div class="row">
        <div class="col-md-12">
        <div class="well">
            {!! $associazione->descrizione !!}
        </div>
        </div>
    </div><div class="row">
        <div class="col-md-12">
            <div class="" id="calendar">
            </div>
        </div>
    </div>
</div>-->
@endsection

@section('scripts')
<script type="text/javascript">

var eventi = [
    @foreach($associazione->eventi() as $evento)
        @foreach($evento->giorni as $giorno)
           {
              title  : "{{ $evento->nome }} - {{ $giorno->descrizione }}",
              start  : "{{ $giorno->giorno.'T'.$giorno->da }}",
              end    : "{{ $giorno->giorno.'T'.$giorno->a }}",
              color  : '#C2185B',
              allDay : false,
           },
        @endforeach
    @endforeach
];

var servizi = [
    @foreach($associazione->servizi() as $servizio)
        @foreach($servizio->giorni as $giorno)
           {
              title  : "{{ $servizio->nome }} - {{ $giorno->descrizione }}",
              start  : "{{ $giorno->giorno.'T'.$giorno->da }}",
              end    : "{{ $giorno->giorno.'T'.$giorno->a }}",
              color  : '#C2185B',
              allDay : false,
           },
        @endforeach
    @endforeach
];

$(document).ready(function() {
    $('#calendar').fullCalendar({
        defaultView: 'listWeek',
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
        events: eventi.concat(servizi),
        viewRender: function( view, element ){
            $('#calendar .fc-scroller').attr("style", "overflow-x: hidden; overflow-y: auto; height: auto;");
        },
        windowResize: function( view, element ){
            $('#calendar .fc-scroller').attr("style", "overflow-x: hidden; overflow-y: auto; height: auto;");
        },
    });
    
    $("#elimina").click(function(){
        swal({
          title: 'Sei sicuro di voler eliminare questo associazione?',
          text: "Questa azione non è reversibile!",
          type: 'warning',
          showCancelButton: true,
        }).then(function () {
          $.ajax({
               url: '/associazioni/delete-associazione',
               method: "post",
               data: {id: {{ $associazione->id}} },
               success: function(data) {
                    swal({title:"Fatto!", text:"Associazione eliminata con successo", type:"success", onClose: function(){window.location.href = "/associazioni/view-associazione?id="+data.associazioneid;}});
               },
               error: function() {
                   swal("Errore!", "Errore durante l'eliminazione dell'associazione", "error");
               }
              });
        });
    });
});
</script>
@endsection