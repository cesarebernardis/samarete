@extends('layouts.default')
@section('styles')
<link href="{{ asset('css/progetti/view.css?v='.time()) }}" rel="stylesheet">
@endsection

@section('content')
    <section id="section_589096598" class="section content-box section-border-no section-bborder-no section-height-content section-bgtype-image section-fixed-background-no section-bgstyle-stretch section-triangle-no triangle-location-top parallax-section-no section-overlay-no section-overlay-dot-no ">
        <div class="section-overlay" style=""></div>
        <div class="container section-content">
            <div class="row-fluid">
                <div class="row-fluid equal-cheight-no element-padding-large element-vpadding-medium">
                    <div class="section-column span6" style="margin-bottom: 0px;">
                        <div class="inner-content content-box textnone" style="padding:0px;">
                            <div class="single-image-container img-align-center ">
                                <div class="single-image" >
                                    <img src="{{ empty($progetto->logo_base64) ? '/public/img/no-image-available.png' : $progetto->logo_base64 }}" class="attachment-full" alt="{{ $progetto->nome }}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-column span6" style="margin-bottom: 0px;">
                        <div class="inner-content content-box textnone" style="padding:0px;">
                            <h2 class="title textleft default bw-2px dh-2px divider-dark bc-dark dw-default color-default" style="margin-bottom:0px">
                                <span>{{ $progetto->nome }}</span>
                            </h2>
                            <div class="hr border-small dh-2px alignleft hr-border-primary">
                                <span></span>
                            </div>
                            <h4 class="title textleft default bw-2px dh-2px divider-dark bc-dark dw-default color-default" style="margin-bottom:0px">
                                <span>Oggetto</span>
                            </h4>
                            <div class="inner-content content-box textnone" style="padding:0px;">
                                <div class="column-text ">{{ $progetto->oggetto }}</div>
                            </div>
                        <div class="col-md-12 text-align-center margin-top-10">
                            @can('invite', $progetto)
                                <div class="inline">
                                <button id="invita" class="button button_default button_color_green button_default border-radius-default icon-align-left" data-toggle="modal" data-target="#modal-form">Invita a collaborare</button>
                                </div>
                            @endcan
                            @can('update', $progetto)
                                <div class="inline">
                                <a id="modifica" class="button button_default button_color_default button_default border-radius-default icon-align-left" title="Modifica" href="/progetti/edit-progetto?id={{ $progetto->id }}"><span>Modifica</span></a>
                                </div>
                            @endcan
                            @can('delete', $progetto)
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
                            <div class="column-text ">{!! $progetto->descrizione !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <div class="row">
        <div class="col-md-12">
            <table id="files" class="table table-bordered table-hover table-striped dataTable">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Dimensione</th>
                        <th>Data caricamento</th>
                        @can('update', $progetto)
                        <th>Pubblico</th>
                        <th></th>
                        @endcan
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    @can('uploadFile', $progetto)
    <div class="row margin-bottom-20">
        <div class="col-md-12">
            <div class="dropzone dz-little" id="upload-file">
                <div class="dz-default dz-message">
                    <span>Trascina i documenti o clicca per selezionarli</span>
                </div>
            </div>
        </div>
        <div class="col-md-12">
        <button type="button" class="button button_default button_color_default button_default border-radius-default icon-align-left" id="confirm-files">Conferma i file caricati</button>
        </div>
    </div>
    @endcan
    @can('update', $progetto)
        @include('chat', ['chat' => $progetto->chat])
    @endcan
</div>

<form class="form-horizontal" id="collaboration-form">
<div class="modal fade" id="modal-form">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Invita a collaborare</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            {{ csrf_field() }}
          <input type="hidden" class="form-control" id="progetto" name="progetto" value="{{ $progetto->id }}"/>
          <div class="form-group">
            <label class="control-label col-sm-4" for="associazioni[]">Associazioni: </label>
            <div class="col-sm-8">
              <select class="form-control" name="associazioni[]" id="associazioni" multiple="multiple">
                @foreach($associazioni as $associazione)
                  <option value="{{ $associazione->id }}">{{ empty($associazione->acronimo) ? $associazione->nome : $associazione->acronimo }}</option>
                @endforeach
              </select>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary submit">Salva</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
      </div>
    </div>
  </div>
</div>
</form>

@endsection

@section('scripts')
<script type="text/javascript">

@can('uploadFile', $progetto)
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
        maxFilesize: 5, //MB
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
@endcan
    
function deleteForm(){
    var progetto = parseInt($(this).attr('data-progetto-id'));
    var file = parseInt($(this).attr('data-file-id'));
    $.ajax({
           url: '/progetti/delete-file',
           method: "post",
           data: {progetto_id: progetto, file_id: file},
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
    var progetto = parseInt($(this).attr('data-progetto-id'));
    var file = parseInt($(this).attr('data-file-id'));
    $.ajax({
           url: '/progetti/publish-file',
           method: "post",
           data: {progetto_id: progetto, file_id: file, public: this.checked * $(this).val()},
           success: function(data) {
                $('#files').DataTable().ajax.reload();
           },
           error: function() {
               swal("Errore!", "Errore durante il salvataggio del file", "error");
           }
       });
}

$(document).ready(function() {
    
    $('div#main_navigation_container ul#main_menu li#menu-item-progetti').addClass('active current-menu-parent');
    
    $('#associazioni').select2();
    
    $("#elimina").click(function(){
        swal({
          title: 'Sei sicuro di voler eliminare questo progetto?',
          text: "Questa azione non è reversibile!",
          type: 'warning',
          showCancelButton: true,
        }).then(function () {
          $.ajax({
               url: '/progetti/delete-progetto',
               method: "post",
               data: {id: {{ $progetto->id}} },
               success: function(data) {
                    swal({title:"Fatto!", text:"Progetto eliminato con successo", type:"success", onClose: function(){window.location.href = "/progetti"}});
               },
               error: function() {
                   swal("Errore!", "Errore durante l'eliminazione dell'progetto", "error");
               }
              });
        });
    });
    
    $("#collaboration-form button.submit").click(function(){
        var data = $("#collaboration-form").serializeArray();
        $.ajax({
           url: '/progetti/invita',
           method: "post",
           data: data,
           success: function() {
               swal("Fatto!", "Associazioni invitate", "success");
               $("#modal-form").modal('hide');
           },
           error: function() {
               swal("Errore!", "Errore durante l'invio dell'invito", "error");
           }
       });
    });
    
    $('#files').DataTable({
        ajax: {
            url: '/progetti/get-files',
            data: { id: {{ $progetto->id }} },
            dataSrc: '',
        },
        columns: [{
                data: "nome_originale",
                render: function ( data, type, row ) {
                    return '<a href="/progetti/download-file?progetto_id={{ $progetto->id }}&file_id='+row.id+'">'+data+'</a>';
                }
            },{
                data: "dimensione",
                render: function ( data, type, row ) {
                    return bytesToSize(data);
                },
            },{
                data: "data_caricamento",
            },
            @can('update', $progetto)
            {
                data: "public",
                class: "text-align-center",
                searchable: false,
                render: function ( data, type, row ) {
                    var checked = ""
                    if(parseInt(data)){
                        checked = "checked";
                    }
                    return '<input class="toggle" type="checkbox" value="1" data-progetto-id="{{ $progetto->id }}" data-file-id="'+row.id+'" '+checked+' />';
                },
            },
            @endcan
            @can('update', $progetto)
            {
                data: "id",
                searchable: false,
                orderable: false,
                width: "100px",
                class: "text-align-center",
                render: function ( data, type, row ) {
                        return '<button class="btn btn-primary btn-icon-only delete red" data-progetto-id="{{ $progetto->id }}" data-file-id="'+row.id+'"><i class="fa fa-trash"></i></button>';
                },
            },
            @endcan
        ],
        drawCallback: function (settings) {
            $('#files button.delete').click(deleteForm);
            $('#files input.toggle').click(toggleForm);
        },
    });
    
    $('button#confirm-files').click(function(){
        
        files = fileDropzone.getAcceptedFiles();
        if(files.length <= 0) return;
        
        var ids = files.map(function(x){ return x.id; }).join()
        
        $.ajax({
           url: '/progetti/confirm-files',
           method: "post",
           data: { progetto_id: {{ $progetto->id }}, file_ids: ids },
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