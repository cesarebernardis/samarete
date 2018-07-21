@extends('layouts.default')
@section('styles')
<link href="{{ asset('css/associazioni/view.css?v='.time()) }}" rel="stylesheet">
@endsection

@section('content')
    <section id="section_589096598" class="section content-box section-border-no section-bborder-no section-height-content section-bgtype-image section-fixed-background-no section-bgstyle-stretch section-triangle-no triangle-location-top parallax-section-no section-overlay-no section-overlay-dot-no ">
        <div class="section-overlay" style="">
        </div>
        <div class="container section-content">
            <div class="row-fluid">
                <div class="row-fluid equal-cheight-no element-padding-large element-vpadding-medium">
                    <div class="section-column span6" style="margin-bottom: 0px;">
                        <div class="inner-content content-box textnone" style="padding:0px;">
                            <div class="single-image-container img-align-center ">
                                <div class="single-image" >
                                    <img src="{{ empty($associazione->logo_base64) ? '/public/img/no-image-available.png' : $associazione->logo_base64 }}" class="attachment-full" alt="{{ $associazione->nome }}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-column span6" style="margin-bottom: 0px;">
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
                                    <div class="col-md-7 ">{{ $associazione->telefono_1.' - '.(empty($associazione->telefono_2) ? '' : $associazione->telefono_2) }}</div>
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
            <div class="col-md-12 text-align-center margin-top-10">
                @can('update', $associazione)
                    <div class="inline">
                    <a id="modifica" class="button button_default button_color_default button_default border-radius-default icon-align-left" title="Modifica" href="/associazioni/edit-associazione?id={{ $associazione->id }}"><span>Modifica</span></a>
                    </div>
                @endcan
                @can('delete', $associazione)
                    <div class="inline">
                    <a id="elimina" class="button button_default button_color_black button_default border-radius-default icon-align-left" title="Elimina" href="#"><span>Elimina</span></a>
                    </div>
                @endcan
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
                            <div class="column-text ">
                                {!! $associazione->descrizione !!}
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
                            <table id="files" class="table table-bordered table-hover table-striped dataTable">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Dimensione</th>
                                        <th>Data caricamento</th>
                                        @can('update', $associazione)
                                        <th>Pubblico</th>
                                        <th></th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @can('update', $associazione)
            <div class="row-fluid">
                <div class="row-fluid equal-cheight-no element-padding-medium element-vpadding-medium">
                    <div class="section-column span12" style="">
                        <div class="inner-content content-box textnone" style="padding:0px;">
                            <div class="dropzone dz-little" id="upload-file">
                                <div class="dz-default dz-message">
                                    <span>Trascina i documenti o clicca per selezionarli</span>
                                </div>
                            </div>
                            <div class="col-md-12 margin-top-10">
                                <button type="button" class="button button_default button_color_default button_small border-radius-default icon-align-left" id="confirm-files">Conferma i file caricati</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
        </div>
    </section>
    <section class="section content-box section-border-no section-bborder-no section-height-content section-bgtype-image section-fixed-background-no section-bgstyle-stretch section-triangle-no triangle-location-top parallax-section-no section-overlay-no section-overlay-dot-no " data-video-ratio="" data-parallax-speed="1">
        <div class="section-overlay" style=""></div>
        <div class="container section-content">
            <div class="row-fluid">
                <div class="row-fluid equal-cheight-no element-padding-default element-vpadding-medium">
                    <div class="section-column span12" style="">
                        <div class="inner-content content-box textnone" id="div_c1fb_3">
                            <div id="feature_boxes_container_1753603451" class="clearfix">
                                <div id="feature_boxes_1" class="row-fluid style1 background-shadow-no feature_boxes box-style3 enable-hr-no element-vpadding- hr-type-tiny hr-color-default hr-style-style1 
                                            ex-large-size element-inner-vertical-padding-medium element-inner-horizental-padding-medium icon-side-left iconbox-style3 align-content-center-yes 
                                            align-icon-center-yes columns-{{ min(3, count($associazione->categorie_servizi())) }} crease-background-no content-box default element-padding-medium ">
                                    @foreach($associazione->categorie_servizi() as $catservizi)
                                    <div class="span">
                                        <div class="inner-content " data-animation-delay="0" data-animation-effect="">
                                            <div class="feature_box ">
                                                <!-- <span class="brad-icon " data-animation-delay="0" data-animation-effect=""><i class="fa-icon_laptop"></i></span> -->
                                                <img src="/public/img/catservizi/{{ $catservizi->icona }}" class=""/>
                                                <div class="heading">
                                                    <div class="heading-content">
                                                        <h2>{{ $catservizi->nome }}</h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script type="text/javascript">

@can('update', $associazione)
var fileDropzone = new Dropzone("div#upload-file", {
		paramName: "file", 
        url: "/file/upload",
		//acceptedFiles: "image/*",
		addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
		removedfile: function(file) {
            if(file.id){
                $.ajax({
                    type: 'POST',
                    url: '/file/delete-tmp',
                    data: {id: file.id}
                });
            }
    		return file.previewElement != null ? file.previewElement.parentNode.removeChild(file.previewElement) : void 0;
		},
        success: function(file, response){
            if(response){
                file.id = response.file_id;
                $("div#upload-logo .dz-message span").hide();
            }
        },
		maxFiles: 10,
        maxFilesize: 10, //MB
        init: function() {
            this.on("maxfilesexceeded", function(file) {
                if(file != null && this.files.length > 10){
                  this.removeFile(file);
                  swal("Attento!", "Puoi caricare solo 10 file alla volta!", "warning");
                }
            });
            
            this.on("addedfile", function(file) { $('button#confirm-files').prop("disabled", true); });
            this.on("queuecomplete", function(file) { $('button#confirm-files').prop("disabled", false); });
        },
		uploadMultiple: false, 
		dictMaxFilesExceeded: "Puoi caricaricare al massimo 10 file alla volta.",
		dictRemoveFile: "Cancella file",
		dictInvalidFileType: "Formato file non valido."
    });
 
function deleteForm(){
    var associazione = parseInt($(this).attr('data-associazione-id'));
    var file = parseInt($(this).attr('data-file-id'));
    $.ajax({
           url: '/associazioni/delete-file',
           method: "post",
           data: {associazione_id: associazione, file_id: file},
           success: function(data) {
                swal("Fatto!", "File eliminato con successo", "success");
                $('#files').DataTable().ajax.reload();
           },
           error: function() {
               swal("Errore!", "Errore durante l'eliminazione del file", "error");
           }
       });
}
    
function toggleForm(){
    var associazione = parseInt($(this).attr('data-associazione-id'));
    var file = parseInt($(this).attr('data-file-id'));
    $.ajax({
           url: '/associazioni/publish-file',
           method: "post",
           data: {associazione_id: associazione, file_id: file, public: this.checked * $(this).val()},
           success: function(data) {
                $('#files').DataTable().ajax.reload();
           },
           error: function() {
               swal("Errore!", "Errore durante il salvataggio del file", "error");
           }
       });
} 
  
@endcan

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
    
    $('div#main_navigation_container ul#main_menu li#menu-item-associazioni').addClass('active current-menu-parent');
    
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
          title: 'Sei sicuro di voler eliminare questa associazione?',
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
    
    $('#files').DataTable({
        ajax: {
            url: '/associazioni/get-files',
            data: { id: {{ $associazione->id }} },
            dataSrc: '',
        },
        columns: [{
                data: "nome_originale",
                render: function ( data, type, row ) {
                    return '<a href="/progetti/download-file?associazione_id={{ $associazione->id }}&file_id='+row.id+'">'+data+'</a>';
                }
            },{
                data: "dimensione",
                render: function ( data, type, row ) {
                    return bytesToSize(data);
                },
            },{
                data: "data_caricamento",
            },
            @can('update', $associazione)
            {
                data: "public",
                class: "text-align-center",
                searchable: false,
                render: function ( data, type, row ) {
                    var checked = ""
                    if(parseInt(data)){
                        checked = "checked";
                    }
                    return '<input class="toggle" type="checkbox" value="1" data-associazione-id="{{ $associazione->id }}" data-file-id="'+row.id+'" '+checked+' />';
                },
            },
            @endcan
            @can('update', $associazione)
            {
                data: "id",
                searchable: false,
                orderable: false,
                width: "100px",
                class: "text-align-center",
                render: function ( data, type, row ) {
                        return '<button class="btn btn-primary btn-icon-only delete red" data-associazione-id="{{ $associazione->id }}" data-file-id="'+row.id+'"><i class="fa fa-trash"></i></button>';
                },
            },
            @endcan
        ],
        @can('update', $associazione)
        drawCallback: function (settings) {
            $('#files button.delete').click(deleteForm);
            $('#files input.toggle').click(toggleForm);
        },
        @endcan
    });
    
    $('button#confirm-files').click(function(){
        
        files = fileDropzone.getAcceptedFiles();
        if(files.length <= 0) return;
        
        var ids = files.map(function(x){ return x.id; }).join()
        
        $.ajax({
           url: '/associazioni/confirm-files',
           method: "post",
           data: { associazione_id: {{ $associazione->id }}, file_ids: ids },
           success: function() {
               swal("Fatto!", "File confermati", "success");
               $('#files').DataTable().ajax.reload();
               fileDropzone.removeAllFiles();
           },
           error: function() {
               swal("Errore!", "Errore durante la conferma dei file", "error");
           }
       });
    });
});
</script>
@endsection