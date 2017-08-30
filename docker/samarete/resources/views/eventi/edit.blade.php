@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/eventi/edit.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row margin-bottom-20 border-bottom-thin">
        <div class="col-md-12 text-align-center"><h2 class="title">Nuovo/Modifica Evento</h2></div>
    </div>
    <form class="form-horizontal" id="evento">
    <div class="row">
        <div class="col-md-12">
            {{ csrf_field() }}
                      <input type="hidden" class="form-control" id="id" name="id" value="{{ $evento ? $evento->id : '' }}">
                      <input type="hidden" class="form-control" id="creatore_id" name="creatore_id" value="{{ $associazione->id }}">
                      <div class="form-group">
                        <label class="control-label col-sm-4" for="nome">Nome*: </label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="{{ $evento ? $evento->nome : '' }}" autofocus>
                        </div>
                      </div><div class="form-group">
                        <label class="control-label col-sm-4">Logo: </label>
                        <input type="hidden" class="form-control" id="logo" name="logo" value="{{ $evento ? $evento->logo : '' }}">
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
                          <input type="textarea" class="form-control" id="oggetto" name="oggetto" placeholder="Oggetto" value="{{ $evento ? $evento->oggetto : '' }}">
                        </div>
                      </div><div class="form-group">
                        <label class="control-label col-sm-4" for="descrizione">Descrizione: </label>
                        <div class="col-sm-8">
                          <input type="textarea" class="form-control" id="descrizione" name="descrizione" placeholder="Descrizione" value="{{ $evento ? $evento->descrizione : '' }}">
                        </div>
                      </div>
                      <div class="giorni">
                          <div class="form-group">
                              <label class="control-label col-sm-4" for="descrizione"></label>
                              <div class="col-sm-8 border-bottom-thin">
                                  <h4>Durata Evento</h4>
                              </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-sm-4" for="descrizione"></label>
                          <div class="col-sm-4">
                              <i class="fa fa-1_5 fa-plus-circle green-text hover-cursor-pointer" onclick="addDay()"></i>
                              <i class="fa fa-1_5 fa-minus-circle red-text hover-cursor-pointer" onclick="removeDay()"></i>
                          </div>
                      </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8"></div>
        <div class="col-md-4 text-align-right">
            <button type="button" class="btn btn-primary submit">Salva</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
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
			var name = $("#filename").val();
			$.ajax({
				type: 'POST',
				url: '/file/delete-tmp',
				data: "id="+name
			});
			$("#new_logo").val("");
            $("div#upload-logo .dz-message span").show();
			var _ref;
    		return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
		},
        success: function(file, response){
            if(response){
                $("#new_logo").val(response.file_id);
                $("div#upload-logo .dz-message span").hide();
            }
        },
		maxFiles: 1,
        maxFilesize: 5, //MB
		uploadMultiple: false, 
		dictMaxFilesExceeded: "Puoi caricaricare solo 1 file alla volta.",
		dictRemoveFile: "Cancella file",
		dictInvalidFileType: "Formato file non valido."
    });

function addDay(){
    var n = $("div.giorni .giorno").length + 1;
    var id = 'giorno_'+n;
    var html = '\
        <div class="form-group" id="'+id+'">\
          <label class="control-label col-sm-4" for="descrizione">Giorno '+n+': </label>\
            <div class="col-sm-8">\
              <div class="input-group date giorno">\
                <input type="text" name="giorno[data][]" class="form-control data" />\
                <span class="input-group-addon">\
                  <span class="glyphicon glyphicon-calendar"></span>\
                </span>\
              </div>\
            </div>\
            <div class="col-sm-4"></div>\
            <div class="col-sm-4">Da\
              <div class="input-group date da">\
                <input type="text" name="giorno[da][]" class="form-control da" />\
                <span class="input-group-addon">\
                  <span class="glyphicon glyphicon-time"></span>\
                </span>\
              </div>\
            </div>\
            <div class="col-sm-4">A\
              <div class="input-group date a">\
                <input type="text" name="giorno[a][]" class="form-control a" />\
                <span class="input-group-addon">\
                  <span class="glyphicon glyphicon-time"></span>\
                </span>\
              </div>\
            </div>\
        </div>\
    ';
    $(".giorni").append(html);
    $("#"+id+" .giorno").datetimepicker({
        locale: 'it',
        minDate: moment(),
        defaultDate: moment().add(1, 'day'),
        format: "DD/MM/YYYY",
    });
    $("#"+id+" .da").datetimepicker({
        locale: 'it',
        format: "LT",
    });
    $("#"+id+" .a").datetimepicker({
        locale: 'it',
        format: "LT",
        useCurrent: false,
    });
    
    $("#"+id+" .da").on("dp.change", function (e) {
        $("#"+id+" .a").data("DateTimePicker").minDate(e.date);
    });
    $("#"+id+" .a").on("dp.change", function (e) {
        $("#"+id+" .da").data("DateTimePicker").maxDate(e.date);
    });
}

function removeDay(){
    var n = $("div.giorni .giorno").length;
    var id = "#giorno_"+parseInt(n);
    if($(id)) $(id).remove();
}

$(document).ready(function() {
    
    @if (!empty($evento))

        <?php
        $i = 1;
        foreach($evento->giorni as $giorno){
            $from = date_create($giorno->giorno.' '.$giorno->da) ;
            $to = date_create($giorno->giorno.' '.$giorno->a) ;
            echo "addDay();\n";
            echo "$('#giorno_".$i." .data').val('".date_format($from, 'd/m/Y')."');\n";
            echo "$('#giorno_".$i." .da').val('".date_format($from, 'H:i')."');\n";
            echo "$('#giorno_".$i." .a').val('".date_format($to, 'H:i')."');\n";
            $i++;
        }
        ?>

        $.ajax({
           url: '/eventi/get-logo',
           method: "post",
           data: {id: {{ $evento->id }} },
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
    @else
        addDay();
    @endif
    
    var form = $('form#evento').validate({
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
    
    $("#evento button.submit").click(function(){
        if(!$('form#evento').valid())
            return;
        var data = $("#evento").serializeArray();
        $.ajax({
           url: '/eventi/save-evento',
           method: "post",
           data: data,
           success: function(data) {
               swal({title:"Fatto!", text:"Salvataggio riuscito", type:"success", onClose: function(){window.location.href = "/eventi/view-evento?id="+data.eventoid;}});
           },
           error: function() {
               swal("Errore!", "Errore durante il salvataggio dell'evento", "error");
           }
       });
    });
});
</script>
@endsection