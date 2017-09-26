@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Associazioni</h2>
            <table id="associazioni" class="table table-bordered table-hover table-striped dataTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Acronimo</th>
                        <th>Email</th>
                        <th>Sito WEB</th>
                        <th>Attivo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-form" onclick="cleanForm();"> Nuova Associazione </button>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-form">
<form class="form-horizontal" id="associazione-form">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nuovo/Modifica Associazione</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            {{ csrf_field() }}
          <input type="hidden" class="form-control" id="id" name="id">
          <div class="form-group">
            <label class="control-label col-sm-4" for="nome">Nome*: </label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" autofocus>
            </div>
          </div><div class="form-group">
            <label class="control-label col-sm-4" for="acronimo">Acronimo: </label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="acronimo" name="acronimo" placeholder="Acronimo">
            </div>
          </div><div class="form-group">
            <label class="control-label col-sm-4" for="indirizzo">Indirizzo: </label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="indirizzo" name="indirizzo" placeholder="Indirizzo">
            </div>
          </div><div class="form-group">
            <label class="control-label col-sm-4" for="telefono_1">Telefono 1: </label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="telefono_1" name="telefono_1" placeholder="Telefono 1">
            </div>
          </div><div class="form-group">
            <label class="control-label col-sm-4" for="telefono_2">Telefono 2: </label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="telefono_2" name="telefono_2" placeholder="Telefono 2">
            </div>
          </div><div class="form-group">
            <label class="control-label col-sm-4" for="email">Email: </label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="email" name="email" placeholder="Email">
            </div>
          </div><div class="form-group">
            <label class="control-label col-sm-4" for="sito_web">Sito WEB: </label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="sito_web" name="sito_web" placeholder="Sito WEB">
            </div>
          </div><div class="form-group">
            <label class="control-label col-sm-4">Logo: </label>
            <input type="hidden" class="form-control" id="logo" name="logo" value="">
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
              <input type="textarea" class="form-control" id="descrizione" name="descrizione" placeholder="">
            </div>
          </div><div class="form-group">
            <label class="control-label col-sm-4" for="gestore_id">Gestore: </label>
            <div class="col-sm-8">
            <select class="custom-select form-control" name="gestore_id" id="gestore_id">
                    <option value="" selected>Seleziona...</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->nome . " " . $user->cognome }}</option>
                    @endforeach
            </select>
            </div>
          </div>
          <div class="col-sm-12"><h3>Referente</h3></div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="referente_nome">Nome: </label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="referente_nome" name="referente_nome" placeholder="Nome">
            </div>
          </div><div class="form-group">
            <label class="control-label col-sm-4" for="referente_indirizzo">Indirizzo: </label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="referente_indirizzo" name="referente_indirizzo" placeholder="Indirizzo">
            </div>
          </div><div class="form-group">
            <label class="control-label col-sm-4" for="referente_telefono_1">Telefono 1: </label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="referente_telefono_1" name="referente_telefono_1" placeholder="Telefono Primario">
            </div>
          </div><div class="form-group">
            <label class="control-label col-sm-4" for="referente_telefono_2">Telefono 2: </label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="referente_telefono_2" name="referente_telefono_2" placeholder="Telefono Secondario">
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary submit">Salva</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
      </div>
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

function cleanForm(){
    logoDropzone.removeAllFiles();
    $("div#upload-logo .dz-message span").show();
    $('form#associazione-form input').each(function(){
        if($(this).attr('name') != '_token')
            $(this).val("");
    });
}

function updateForm(){
    cleanForm();
    var id = parseInt($(this).attr('data-id'));
    $.ajax({
           url: '/admin/get-associazione',
           method: "post",
           data: {id: id},
           success: function(data) {
                Object.keys(data).forEach(function(key,index) {
                    // key: the name of the object key
                    // index: the ordinal position of the key within the object
                    if($('form#associazione-form #'+key))
                        $('form#associazione-form #'+key).val(data[key]);
                });
                $("#modal-form").modal('show');
           },
           error: function() {
               swal("Errore!", "Errore durante il salvataggio dell'associazione", "error");
           }
       });
    
    $.ajax({
           url: '/associazioni/get-logo',
           method: "post",
           data: {id: id},
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
               $("#modal-logo-form").modal('show');
           },
           error: function() {
               swal("Errore!", "Errore durante il caricamento del logo", "error");
           }
       });
}

function deleteForm(){
    var id = parseInt($(this).attr('data-id'));
    $.ajax({
           url: '/admin/delete-associazione',
           method: "post",
           data: {id: id},
           success: function(data) {
                swal("Fatto!", "Associazione eliminato con successo", "success");
                $('#associazioni').DataTable().ajax.reload();
           },
           error: function() {
               swal("Errore!", "Errore durante il salvataggio dell'associazione", "error");
           }
       });
}

function toggleForm(){
    var id = parseInt($(this).attr('data-id'));
    $.ajax({
           url: '/admin/toggle-associazione',
           method: "post",
           data: {id: id},
           success: function(data) {
                $('#associazioni').DataTable().ajax.reload();
           },
           error: function() {
               swal("Errore!", "Errore durante il salvataggio del associazione", "error");
           }
       });
}

$(document).ready(function() {	
    
    var form = $('form#associazione-form').validate({
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
        }, 
        messages: {
            nome: {
                required: "Inserisci un nome",
                remote: "Nome già in uso",
            },
        },
        submitHandler: function(form) {
            
        }
    });
    
    $("#associazione-form button.submit").click(function(){
        if(!$('form#associazione-form').valid())
            return;
        var data = $("#associazione-form").serializeArray();
        $.ajax({
           url: '/admin/save-associazione',
           method: "post",
           data: data,
           success: function() {
               swal("Fatto!", "Salvataggio riuscito", "success");
               $("#modal-form").modal('hide');
               $('#associazioni').DataTable().ajax.reload();
           },
           error: function() {
               swal("Errore!", "Errore durante il salvataggio del associazione", "error");
           }
       });
    });
    
    $('#associazioni').DataTable({
        ajax: {
            url: '/admin/get-associazioni',
            dataSrc: '',
        },
        columns: [{
                data: "id",
                visible: false,
                searchable: false,
                orderable: false,
            },{
                data: "nome",
            },{
                data: "acronimo",
            },{
                data: "email",
            },{
                data: "sito_web",
            },{
                data: "attivo",
                class: "text-align-center",
                searchable: false,
                render: function ( data, type, row ) {
                    var html = "";
                    if(parseInt(data)){
                        html += '<i class="fa fa-2 fa-check green-text"></i>&nbsp;';
                        html += '<i class="fa fa-2 fa-toggle-off toggle hover-cursor-pointer" data-id="'+row.id+'"></i>';
                    }else{
                        html += '<i class="fa fa-2 fa-times red-text"></i>&nbsp;';
                        html += '<i class="fa fa-2 fa-toggle-on toggle hover-cursor-pointer" data-id="'+row.id+'"></i>';
                    }
                    return html;
                },
            },{
                data: "id",
                searchable: false,
                orderable: false,
                width: "140px",
                class: "text-align-center",
                render: function ( data, type, row ) {
                        html = '<button class="btn btn-primary btn-icon-only edit green" data-id="'+data+'"><i class="fa fa-pencil-square-o"></i></button>&nbsp;';
                        html += '<button class="btn btn-primary btn-icon-only delete red" data-id="'+data+'"><i class="fa fa-trash"></i></button>';
                        return html;
                },
            },
        ],
        drawCallback: function (settings) {
            $('#associazioni button.edit').click(updateForm);
            $('#associazioni button.delete').click(deleteForm);
            $('#associazioni i.fa.toggle').click(toggleForm);
        },
    });
    
});
</script>
@endsection
