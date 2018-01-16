@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Permessi</h2>
            <table id="permessi" class="table table-bordered table-hover table-striped dataTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-form" onclick="cleanForm();"> Nuovo Permesso </button>
        </div>
    </div>
    <form action="/admin" method="GET" class="margin-top-20"><input type="submit" class="btn btn-primary" value="Indietro" /></form>
</div>

<form class="form-horizontal" id="permesso-form">
<div class="modal fade" id="modal-form">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nuovo/Modifica Permesso</h5>
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
    $('form#permesso-form input').each(function(){
        $(this).val("");
    });
}

function updateForm(){
    cleanForm();
    var id = parseInt($(this).attr('data-id'));
    $.ajax({
           url: '/admin/get-permesso',
           method: "post",
           data: {id: id},
           success: function(data) {
                Object.keys(data).forEach(function(key,index) {
                    // key: the name of the object key
                    // index: the ordinal position of the key within the object
                    if($('form#permesso-form #'+key))
                        $('form#permesso-form #'+key).val(data[key]);
                });
                $("#modal-form").modal('show');
           },
           error: function() {
               swal("Errore!", "Errore durante il salvataggio del permesso", "error");
           }
       });
}

function deleteForm(){
    var id = parseInt($(this).attr('data-id'));
    $.ajax({
           url: '/admin/delete-permesso',
           method: "post",
           data: {id: id},
           success: function(data) {
                swal("Fatto!", "Permesso eliminato con successo", "success");
                $('#permessi').DataTable().ajax.reload();
           },
           error: function() {
               swal("Errore!", "Errore durante l'eliminazione del permesso", "error");
           }
       });
}

function toggleForm(){
    var id = parseInt($(this).attr('data-id'));
    $.ajax({
           url: '/admin/toggle-permesso',
           method: "post",
           data: {id: id},
           success: function(data) {
                $('#permessi').DataTable().ajax.reload();
           },
           error: function() {
               swal("Errore!", "Errore durante il salvataggio del permesso", "error");
           }
       });
}

$(document).ready(function() {
    
    var form = $('form#permesso-form').validate({
        rules: {
            nome: {
                required: true,
                remote: {
                    url: "/admin/permesso/check-nome",
                    type: "post",
                    data: {
                      id: function() { return $( "#id" ).val(); },
                      permessoname: function() { return $( "#nome" ).val(); },
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
    
    $("#permesso-form button.submit").click(function(){
        if(!$('form#permesso-form').valid())
            return;
        var data = $("#permesso-form").serializeArray();
        $.ajax({
           url: '/admin/save-permesso',
           method: "post",
           data: data,
           success: function() {
               swal("Fatto!", "Salvataggio riuscito", "success");
               $("#modal-form").modal('hide');
               $('#permessi').DataTable().ajax.reload();
           },
           error: function() {
               swal("Errore!", "Errore durante il salvataggio del permesso", "error");
           }
       });
    });
    
    $('#permessi').DataTable({
        ajax: {
            url: '/admin/get-permessi',
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
            $('#permessi button.edit').click(updateForm);
            $('#permessi button.delete').click(deleteForm);
            $('#permessi i.fa.toggle').click(toggleForm);
        },
    });
    
});
</script>
@endsection
