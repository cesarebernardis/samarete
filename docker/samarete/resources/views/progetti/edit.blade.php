@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/progetti/edit.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row margin-bottom-20 border-bottom-thin">
        <div class="col-md-12 text-align-center"><h2 class="title">Nuovo/Modifica Progetto</h2></div>
    </div>
    <form class="form-horizontal" id="progetto">
    <div class="row">
        <div class="col-md-12">
            {{ csrf_field() }}
                      <input type="hidden" class="form-control" id="id" name="id" value="{{ $progetto ? $progetto->id : '' }}">
                      <input type="hidden" class="form-control" id="creatore_id" name="creatore_id" value="{{ $associazione->id }}">
                      <div class="form-group">
                        <label class="control-label col-sm-4" for="nome">Nome*: </label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="{{ $progetto ? $progetto->nome : '' }}" autofocus>
                        </div>
                      </div><div class="form-group">
                        <label class="control-label col-sm-4">Logo: </label>
                        <input type="hidden" class="form-control" id="logo" name="logo" value="{{ $progetto ? $progetto->logo : '' }}">
                        <input type="hidden" class="form-control" id="new_logo" name="new_logo" value="">
                        <div class="col-sm-8">
                            <div class="dropzone dz-little" id="upload-logo">
                                <div class="dz-default dz-message">
                                   <span>Trascina il logo o clicca per selezionarlo</span>
                                </div>
                            </div>
                        </div>
                      </div><div class="form-group">
                        <label class="control-label col-sm-4" for="oggetto">Oggetto: </label>
                        <div class="col-sm-8">
                          <input type="textarea" class="form-control" id="oggetto" name="oggetto" placeholder="Oggetto" value="{{ $progetto ? $progetto->oggetto : '' }}">
                        </div>
                      </div><div class="form-group">
                        <label class="control-label col-sm-4" for="descrizione">Descrizione: </label>
                        <div class="col-sm-8">
                          <textarea class="form-control" id="descrizione" name="descrizione" placeholder="Descrizione" rows="4">{{ $progetto ? $progetto->descrizione : '' }}</textarea>
                        </div>
                      </div>
                      
        </div>
    </div>
    <div class="row">
        <div class="col-md-8"></div>
        <div class="col-md-4 text-align-right">
            <button type="button" class="btn btn-primary submit">Salva</button>
            <button type="button" class="btn btn-secondary cancel">Annulla</button>
        </div>
    </div>
    </form>
</div>
@endsection

@section('scripts')
<script type="text/javascript">

var logoDropzone = new Dropzone("div#upload-logo", {
		paramName: "file", 
        url: "/file/upload",
		acceptedFiles: "image/*",
		addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
		removedfile: function(file) {
            if($("#new_logo").val()){
                var fileid = $("#new_logo").val();
            }else{
                $("#logo").val("");
            }
            if(fileid){
                $.ajax({
                    type: 'POST',
                    url: '/file/delete-tmp',
                    data: {id: fileid}
                });
                $("#new_logo").val("");
            }
            $("div#upload-logo .dz-message span").show();
    		return file.previewElement != null ? file.previewElement.parentNode.removeChild(file.previewElement) : void 0;
		},
        success: function(file, response){
            if(response){
                $("#new_logo").val(response.file_id);
                $("div#upload-logo .dz-message span").hide();
            }
        },
		maxFiles: 1,
        maxFilesize: 5, //MB
        init: function() {
            this.on("maxfilesexceeded", function(file) {
                if(file != null && this.files.length > 1){
                  this.removeFile(file);
                  swal("Attento!", "Puoi caricare un solo file alla volta!", "warning");
                }
            });
        }  
		uploadMultiple: false, 
		dictMaxFilesExceeded: "Puoi caricaricare solo 1 file alla volta.",
		dictRemoveFile: "Cancella file",
		dictInvalidFileType: "Formato file non valido."
    });


$(document).ready(function() {
    
    @if (!empty($progetto))

        $.ajax({
           url: '/progetti/get-logo',
           method: "post",
           data: {id: {{ $progetto->id }} },
           success: function(data) {
               if(data){
                   // Create the mock file:
                   var mockFile = { name: data.filename, size: data.content.length };
                    // Call the default addedfile event handler
                   logoDropzone.emit("addedfile", mockFile);

                   // Or if the file on your server is not yet in the right
                   // size, you can let Dropzone download and resize it
                   // callback and crossOrigin are optional.
                   logoDropzone.emit("thumbnail", mockFile, data.content);
                    // Make sure that there is no progress bar, etc...
                   logoDropzone.emit("complete", mockFile);
                    // If you use the maxFiles option, make sure you adjust it to the
                   // correct amount:
                   logoDropzone.options.maxFiles = logoDropzone.options.maxFiles - 1;
                   $("div#upload-logo .dz-message span").hide();
               }
           },
           error: function() {
               swal("Errore!", "Errore durante il caricamento del logo", "error");
           }
       });
       
    @endif
    
    var form = $('form#progetto').validate({
        rules: {
            nome: {
                required: true,
            },
        }, 
        messages: {
            nome: {
                required: "Inserisci un nome",
            },
        },
        submitHandler: function(form) {
            
        }
    });
    
    $("#progetto button.submit").click(function(){
        if(!$('form#progetto').valid())
            return;
        var data = $("#progetto").serializeArray();
        $.ajax({
           url: '/progetti/save-progetto',
           method: "post",
           data: data,
           success: function(data) {
               swal({title:"Fatto!", text:"Salvataggio riuscito", type:"success", onClose: function(){window.location.href = "/progetti/view-progetto?id="+data.progettoid;}});
           },
           error: function() {
               swal("Errore!", "Errore durante il salvataggio dell'progetto", "error");
           }
       });
    });
    
    $("#progetto button.cancel").click(function(){ window.location.href = "/progetti"; });
});
</script>
@endsection