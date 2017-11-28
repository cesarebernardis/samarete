@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Utenti</h2>
            <table id="users" class="table table-bordered table-hover table-striped dataTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Nome</th>
                        <th>Cognome</th>
                        <th>Email</th>
                        <th>Ultimo accesso</th>
                        <th>Attivo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-form" onclick="cleanForm();"> Nuovo Utente </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h2>Ruoli utenti</h2>
            <table id="ruoli-users" class="table table-bordered table-hover table-striped dataTable">
                <thead>
                    <tr>
                        <th>Utente</th>
                        <th>ID Utente</th>
                        <th>Ruolo</th>
                        <th>ID Ruolo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <form class="form-inline" id="user-ruolo-form">
              <div class="form-group margin-right-20">
                <label class="mr-sm-2" for="user_id">Utente*: </label>
                <select class="custom-select form-control" name="user_id" id="user_id">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->nome }} {{ $user->cognome }}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group margin-right-20">
                <label class="mr-sm-2" for="ruolo_id">Ruolo*: </label>
                <select class="custom-select form-control" name="ruolo_id" id="ruolo_id">
                    @foreach ($ruoli as $ruolo)
                        <option value="{{ $ruolo->id }}">{{ $ruolo->nome }}</option>
                    @endforeach
                </select>
              </div>
            <input type="submit" class="btn btn-primary" id="assegna-ruolo" value="Assegna Ruolo" />
            </form>
        </div>
    </div>
    <form action="/admin" method="GET" class="margin-top-20"><input type="submit" class="btn btn-primary" value="Indietro" /></form>
</div>

<form class="form-horizontal" id="user-form">
<div class="modal fade" id="modal-form">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nuovo/Modifica Utente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            {{ csrf_field() }}
          <input type="hidden" class="form-control" id="id" name="id">
          <div class="form-group">
            <label class="control-label col-sm-4" for="username">Username*: </label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="username" name="username" placeholder="Username" autofocus>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="password">Password*: </label>
            <div class="col-sm-8">
              <input type="password" class="form-control" id="password" name="password" placeholder="">
              <p class="form-text text-muted old-password">
                    Se la password non viene inserita, non verr&agrave; modificata
              </p>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="conferma_password">Conferma Password*: </label>
            <div class="col-sm-8">
              <input type="password" class="form-control" id="conferma_password" name="conferma_password" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="nome">Nome*: </label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="cognome">Cognome*: </label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="cognome" name="cognome" placeholder="Cognome">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="email">Email*: </label>
            <div class="col-sm-8">
              <input type="email" class="form-control" id="email" name="email" placeholder="Email">
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
    $('form#user-form .old-password').addClass("display-none");
    $('form#user-form #password').rules("add", {
        required: true,
        messages: {
            required: "Inserisci una password"
        }
    });
    $('form#user-form input').each(function(){
        $(this).val("");
    });
}

function updateForm(){
    cleanForm();
    $('form#user-form .old-password').removeClass("display-none");
    $('form#user-form #password').rules("remove", "required");
    var id = parseInt($(this).attr('data-id'));
    $.ajax({
           url: '/admin/get-user',
           method: "post",
           data: {id: id},
           success: function(data) {
                Object.keys(data).forEach(function(key,index) {
                    // key: the name of the object key
                    // index: the ordinal position of the key within the object
                    if($('form#user-form #'+key))
                        $('form#user-form #'+key).val(data[key]);
                });
                $("#modal-form").modal('show');
           },
           error: function() {
               swal("Errore!", "Errore durante il salvataggio dell'utente", "error");
           }
       });
}

function deleteForm(){
    var id = parseInt($(this).attr('data-id'));
    $.ajax({
           url: '/admin/delete-user',
           method: "post",
           data: {id: id},
           success: function(data) {
                swal("Fatto!", "Utente eliminato con successo", "success");
                $('#users').DataTable().ajax.reload();
           },
           error: function() {
               swal("Errore!", "Errore durante il salvataggio dell'utente", "error");
           }
       });
}

function toggleForm(){
    var id = parseInt($(this).attr('data-id'));
    $.ajax({
           url: '/admin/toggle-user',
           method: "post",
           data: {id: id},
           success: function(data) {
                $('#users').DataTable().ajax.reload();
           },
           error: function() {
               swal("Errore!", "Errore durante il salvataggio dell'utente", "error");
           }
       });
}

function revokeForm(){
    var userid = parseInt($(this).attr('data-user-id'));
    var ruoloid = parseInt($(this).attr('data-ruolo-id'));
    $.ajax({
           url: '/admin/revoke-ruolo',
           method: "post",
           data: {user_id: userid, ruolo_id: ruoloid},
           success: function(data) {
                swal("Fatto!", "Ruolo revocato con successo", "success");
                $('#ruoli-users').DataTable().ajax.reload();
           },
           error: function() {
               swal("Errore!", "Errore durante la revoca del ruolo", "error");
           }
       });
}

$(document).ready(function() {
    
    $('form#user-ruolo-form select#user_id').select2({
        placeholder: 'Seleziona utente',
    });
    $('form#user-ruolo-form select#ruolo_id').select2({
        placeholder: 'Seleziona ruolo',
    });
    
    var form = $('form#user-form').validate({
        rules: {
            username: {
                required: true,
                remote: {
                    url: "/admin/users/check-username",
                    type: "post",
                    data: {
                      id: function() { return $( "#id" ).val(); },
                      username: function() { return $( "#username" ).val(); },
                    }
                }
            },
            email: {
                required: true,
                email: true,
            },
            conferma_password: {
                equalTo: "#password",
            },
            nome: {
                required: true,
            },
            cognome: {
                required: true,
            },
        }, 
        messages: {
            username: {
                required: "Inserisci uno Username",
                remote: "Username già in uso",
            },
            email: {
                required: "Inserisci un indirizzo email",
                email: "L'indirizzo email inserito non è valido",
            },
            conferma_password: {
                equalTo: "La password di conferma non coincide",
            },
            nome: {
                required: "Inserisci un nome",
            },
            cognome: {
                required: "Inserisci un cognome",
            },
        },
        submitHandler: function(form) {
            
        }
    });
    
    $("#user-form button.submit").click(function(){
        if(!$('form#user-form').valid())
            return;
        var data = $("#user-form").serializeArray();
        $.ajax({
           url: '/admin/save-user',
           method: "post",
           data: data,
           success: function() {
               swal("Fatto!", "Salvataggio riuscito", "success");
               $("#modal-form").modal('hide');
               $('#users').DataTable().ajax.reload();
           },
           error: function() {
               swal("Errore!", "Errore durante il salvataggio dell'utente", "error");
           }
       });
    });
    
    $('#users').DataTable({
        ajax: {
            url: '/admin/get-users',
            dataSrc: '',
        },
        columns: [{
                data: "id",
                visible: false,
                searchable: false,
                orderable: false,
            },{
                data: "username",
            },{
                data: "nome",
            },{
                data: "cognome",
            },{
                data: "email",
            },{
                data: "ultimo_accesso",
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
            $('#users button.edit').click(updateForm);
            $('#users button.delete').click(deleteForm);
            $('#users i.fa.toggle').click(toggleForm);
        },
    });
    
    $('#ruoli-users').DataTable({
        ajax: {
            url: '/admin/get-ruoli-users',
            dataSrc: '',
        },
        columns: [{
                data: "user_nome",
            },{
                data: "user_id",
                visible: false,
                searchable: false,
                orderable: false,
            },{
                data: "ruolo_nome",
            },{
                data: "ruolo_id",
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
                        return '<button class="btn btn-primary btn-icon-only delete red" data-user-id="'+row.user_id+'" data-ruolo-id="'+row.ruolo_id+'"><i class="fa fa-trash"></i></button>';
                },
            },
        ],
        drawCallback: function (settings) {
            $('#ruoli-users button.delete').click(revokeForm);
        },
    });
    
    $("form#user-ruolo-form #assegna-ruolo").click(function(e){
        e.preventDefault();
        var data = $("form#user-ruolo-form").serializeArray();
        $.ajax({
           url: '/admin/add-ruolo',
           method: "post",
           data: data,
           success: function(data) {
                swal("Fatto!", "Ruolo assegnato con successo", "success");
                $('#ruoli-users').DataTable().ajax.reload();
           },
           error: function() {
               swal("Errore!", "Errore durante l'assegnamento del ruolo", "error");
           }
       });
    });
});
</script>
@endsection
