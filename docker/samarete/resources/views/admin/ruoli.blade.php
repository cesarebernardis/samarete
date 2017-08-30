@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Ruoli</h2>
            <table id="ruoli" class="table table-bordered table-hover table-striped dataTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Attivo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-form" onclick="cleanForm();"> Nuovo Ruolo </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h2>Permessi ruoli</h2>
            <table id="permessi-ruoli" class="table table-bordered table-hover table-striped dataTable">
                <thead>
                    <tr>
                        <th>Ruolo</th>
                        <th>ID Ruolo</th>
                        <th>Permesso</th>
                        <th>ID Permesso</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <form class="form-inline" id="ruolo-permesso-form">
              <div class="form-group margin-right-20">
                <label class="mr-sm-2" for="ruolo_id">Ruolo*: </label>
                <select class="custom-select form-control" name="ruolo_id" id="ruolo_id">
                    @foreach ($ruoli as $ruolo)
                        <option value="{{ $ruolo->id }}">{{ $ruolo->nome }}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group margin-right-20">
                <label class="mr-sm-2" for="permesso_id">Permesso*: </label>
                <select class="custom-select form-control" name="permesso_id" id="permesso_id">
                    @foreach ($permessi as $permesso)
                        <option value="{{ $permesso->id }}">{{ $permesso->nome }}</option>
                    @endforeach
                </select>
              </div>
            <input type="submit" class="btn btn-primary" id="assegna-ruolo" value="Assegna Ruolo" />
            </form>
        </div>
    </div>
</div>

<form class="form-horizontal" id="ruolo-form">
<div class="modal fade" id="modal-form">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nuovo/Modifica Ruolo</h5>
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

function cleanForm(){
    $('form#ruolo-form input').each(function(){
        $(this).val("");
    });
}

function updateForm(){
    cleanForm();
    var id = parseInt($(this).attr('data-id'));
    $.ajax({
           url: '/admin/get-ruolo',
           method: "post",
           data: {id: id},
           success: function(data) {
                Object.keys(data).forEach(function(key,index) {
                    // key: the name of the object key
                    // index: the ordinal position of the key within the object
                    if($('form#ruolo-form #'+key))
                        $('form#ruolo-form #'+key).val(data[key]);
                });
                $("#modal-form").modal('show');
           },
           error: function() {
               swal("Errore!", "Errore durante il salvataggio dell'ruolo", "error");
           }
       });
}

function deleteForm(){
    var id = parseInt($(this).attr('data-id'));
    $.ajax({
           url: '/admin/delete-ruolo',
           method: "post",
           data: {id: id},
           success: function(data) {
                swal("Fatto!", "Ruolo eliminato con successo", "success");
                $('#ruoli').DataTable().ajax.reload();
           },
           error: function() {
               swal("Errore!", "Errore durante il salvataggio del ruolo", "error");
           }
       });
}

function toggleForm(){
    var id = parseInt($(this).attr('data-id'));
    $.ajax({
           url: '/admin/toggle-ruolo',
           method: "post",
           data: {id: id},
           success: function(data) {
                $('#ruoli').DataTable().ajax.reload();
           },
           error: function() {
               swal("Errore!", "Errore durante il salvataggio del ruolo", "error");
           }
       });
}

function revokeForm(){
    var permessoid = parseInt($(this).attr('data-permesso-id'));
    var ruoloid = parseInt($(this).attr('data-ruolo-id'));
    $.ajax({
           url: '/admin/revoke-permesso',
           method: "post",
           data: {permesso_id: permessoid, ruolo_id: ruoloid},
           success: function(data) {
                swal("Fatto!", "Ruolo revocato con successo", "success");
                $('#permessi-ruoli').DataTable().ajax.reload();
           },
           error: function() {
               swal("Errore!", "Errore durante la revoca del ruolo", "error");
           }
       });
}

$(document).ready(function() {
    
    $('form#ruolo-permesso-form select#permesso_id').select2({
        placeholder: 'Seleziona permesso',
    });
    $('form#ruolo-permesso-form select#ruolo_id').select2({
        placeholder: 'Seleziona ruolo',
    });
    
    var form = $('form#ruolo-form').validate({
        rules: {
            nome: {
                required: true,
                remote: {
                    url: "/admin/ruolo/check-nome",
                    type: "post",
                    data: {
                      id: function() { return $( "#id" ).val(); },
                      ruoloname: function() { return $( "#nome" ).val(); },
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
    
    $("#ruolo-form button.submit").click(function(){
        if(!$('form#ruolo-form').valid())
            return;
        var data = $("#ruolo-form").serializeArray();
        $.ajax({
           url: '/admin/save-ruolo',
           method: "post",
           data: data,
           success: function() {
               swal("Fatto!", "Salvataggio riuscito", "success");
               $("#modal-form").modal('hide');
               $('#ruoli').DataTable().ajax.reload();
           },
           error: function() {
               swal("Errore!", "Errore durante il salvataggio del ruolo", "error");
           }
       });
    });
    
    $('#ruoli').DataTable({
        ajax: {
            url: '/admin/get-ruoli',
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
                width: "100px",
                class: "text-align-center",
                render: function ( data, type, row ) {
                        html = '<button class="btn btn-primary btn-icon-only edit green" data-id="'+data+'"><i class="fa fa-pencil-square-o"></i></button>&nbsp;';
                        html += '<button class="btn btn-primary btn-icon-only delete red" data-id="'+data+'"><i class="fa fa-trash"></i></button>';
                        return html;
                },
            },
        ],
        drawCallback: function (settings) {
            $('#ruoli button.edit').click(updateForm);
            $('#ruoli button.delete').click(deleteForm);
            $('#ruoli i.fa.toggle').click(toggleForm);
        },
    });
    
    
    $('#permessi-ruoli').DataTable({
        ajax: {
            url: '/admin/get-permessi-ruoli',
            dataSrc: '',
        },
        columns: [{
                data: "ruolo_nome",
            },{
                data: "ruolo_id",
                visible: false,
                searchable: false,
                orderable: false,
            },{
                data: "permesso_nome",
            },{
                data: "permesso_id",
                visible: false,
                searchable: false,
                orderable: false,
            },{
                data: "user_id",
                searchable: false,
                orderable: false,
                width: "100px",
                class: "text-align-center",
                render: function ( data, type, row ) {
                        return '<button class="btn btn-primary btn-icon-only delete red" data-permesso-id="'+row.permesso_id+'" data-ruolo-id="'+row.ruolo_id+'"><i class="fa fa-trash"></i></button>';
                },
            },
        ],
        drawCallback: function (settings) {
            $('#permessi-ruoli button.delete').click(revokeForm);
        },
    });
    
    $("form#ruolo-permesso-form #assegna-ruolo").click(function(e){
        e.preventDefault();
        var data = $("form#ruolo-permesso-form").serializeArray();
        $.ajax({
           url: '/admin/add-permesso',
           method: "post",
           data: data,
           success: function(data) {
                swal("Fatto!", "Permesso assegnato con successo", "success");
                $('#permessi-ruoli').DataTable().ajax.reload();
           },
           error: function() {
               swal("Errore!", "Errore durante l'assegnamento del permesso", "error");
           }
       });
    });
});
</script>
@endsection
