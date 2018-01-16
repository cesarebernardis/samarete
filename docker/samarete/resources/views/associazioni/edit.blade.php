@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/associazioni/edit.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row margin-bottom-20 border-bottom-thin">
        <div class="col-md-12 text-align-center"><h2 class="title">Nuovo/Modifica Associazione</h2></div>
    </div>
    <form class="form-horizontal" id="associazione">
    <div class="row">
        <div class="col-md-12">
            {{ csrf_field() }}
                      <input type="hidden" class="form-control" id="id" name="id" value="{{ $associazione ? $associazione->id : '' }}">
                      <div class="form-group">
                        <label class="control-label col-sm-4" for="nome">Nome*: </label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="{{ $associazione ? $associazione->nome : '' }}" autofocus>
                        </div>
                      </div><div class="form-group">
                        <label class="control-label col-sm-4" for="acronimo">Acronimo: </label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="acronimo" name="acronimo" placeholder="Acronimo" value="{{ $associazione ? $associazione->acronimo : '' }}">
                        </div>
                      </div><div class="form-group">
                        <label class="control-label col-sm-4" for="indirizzo">Indirizzo: </label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="indirizzo" name="indirizzo" placeholder="Indirizzo"value="{{ $associazione ? $associazione->indirizzo : '' }}">
                        </div>
                      </div><div class="form-group">
                        <label class="control-label col-sm-4" for="telefono_1">Telefono 1: </label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="telefono_1" name="telefono_1" placeholder="Telefono 1" value="{{ $associazione ? $associazione->telefono_1 : '' }}">
                        </div>
                      </div><div class="form-group">
                        <label class="control-label col-sm-4" for="telefono_2">Telefono 2: </label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="telefono_2" name="telefono_2" placeholder="Telefono 2" value="{{ $associazione ? $associazione->telefono_2 : '' }}">
                        </div>
                      </div><div class="form-group">
                        <label class="control-label col-sm-4" for="email">Email: </label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ $associazione ? $associazione->email : '' }}">
                        </div>
                      </div><div class="form-group">
                        <label class="control-label col-sm-4" for="sito_web">Sito WEB: </label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="sito_web" name="sito_web" placeholder="Sito WEB" value="{{ $associazione ? $associazione->sito_web : '' }}">
                        </div>
                      </div><div class="form-group">
                        <label class="control-label col-sm-4">Logo: </label>
                        <input type="hidden" class="form-control" id="logo" name="logo" value="{{ $associazione ? $associazione->logo : '' }}">
                        <input type="hidden" class="form-control" id="new_logo" name="new_logo" value="">
                        <div class="col-sm-8">
                            <div class="dropzone dz-little" id="upload-logo">
                                <div class="dz-default dz-message">
                                   <span>Trascina il logo o clicca per selezionarlo</span>
                                </div>
                            </div>
                        </div>
                      </div><div class="form-group">
                        <label class="control-label col-sm-4" for="descrizione">Descrizione: </label>
                        <div class="col-sm-8">
                          <textarea class="form-control tinymce" id="descrizione" name="descrizione" rows="12">{!! $associazione ? $associazione->descrizione : '' !!}</textarea>
                        </div>
                      </div>
                      @if(Auth::user()->isAdmin())
                        <div class="form-group">
                        <label class="control-label col-sm-4" for="gestore_id">Gestore: </label>
                        <div class="col-sm-8">
                        <select class="custom-select form-control" name="gestore_id" id="gestore_id">
                                <option value="" selected>Seleziona...</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->nome . " " . $user->cognome }}</option>
                                @endforeach
                        </select>
                        </div>
                      @else
                        <input type="hidden" class="form-control" id="gestore_id" name="gestore_id" value="{{ $associazione ? Auth::user()->id : '' }}">
                      @endif
                      <div class="col-sm-12"><h3 class="text-align-center">Referente</h3></div>
                      <div class="form-group">
                        <label class="control-label col-sm-4" for="referente_nome">Nome*: </label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="referente_nome" name="referente_nome" placeholder="Nome" value="{{ $associazione ? $associazione->referente_nome : '' }}">
                        </div>
                      </div><div class="form-group">
                        <label class="control-label col-sm-4" for="referente_indirizzo">Indirizzo: </label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="referente_indirizzo" name="referente_indirizzo" placeholder="Indirizzo" value="{{ $associazione ? $associazione->referente_indirizzo : '' }}">
                        </div>
                      </div><div class="form-group">
                        <label class="control-label col-sm-4" for="referente_telefono_1">Telefono 1: </label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="referente_telefono_1" name="referente_telefono_1" placeholder="Telefono Primario" value="{{ $associazione ? $associazione->referente_telefono_1 : '' }}">
                        </div>
                      </div><div class="form-group">
                        <label class="control-label col-sm-4" for="referente_telefono_2">Telefono 2: </label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="referente_telefono_2" name="referente_telefono_2" placeholder="Telefono Secondario" value="{{ $associazione ? $associazione->referente_telefono_2 : '' }}">
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
        },
		uploadMultiple: false, 
		dictMaxFilesExceeded: "Puoi caricaricare solo 1 file alla volta.",
		dictRemoveFile: "Cancella file",
		dictInvalidFileType: "Formato file non valido."
    });

$(document).ready(function() {
    
    @if (!empty($associazione))

        $.ajax({
           url: '/associazioni/get-logo',
           method: "post",
           data: {id: {{ $associazione->id }} },
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
    
    var form = $('form#associazione').validate({
        rules: {
            nome: {
                required: true,
                remote: {
                    url: "/admin/associazione/check-nome",
                    type: "post",
                    data: {
                      id: function() { return $( "#id" ).val(); },
                      associazionename: function() { return $( "#nome" ).val(); },
                    }
                }
            },
            referente_nome: {
                required: true,
            },
        }, 
        messages: {
            nome: {
                required: "Inserisci un nome",
                remote: "Nome già in uso",
            },
            referente_nome: {
                required: "Inserisci un referente",
            },
        },
        submitHandler: function(form) {
            
        }
    });
    
    $("#associazione button.submit").click(function(){
        tinyMCE.triggerSave();
        if(!$('form#associazione').valid())
            return;
        var data = $("#associazione").serializeArray();
        $.ajax({
           url: '/associazioni/save-associazione',
           method: "post",
           data: data,
           success: function(data) {
               swal({title:"Fatto!", text:"Salvataggio riuscito", type:"success", onClose: function(){window.location.href = "/associazioni/view-associazione?id="+data.associazioneid;}});
           },
           error: function() {
               swal("Errore!", "Errore durante il salvataggio dell'associazione", "error");
           }
       });
    });
    
    $("#associazione button.cancel").click(function(){ window.location.href = "/associazioni"; });
});
</script>
@endsection