@extends('layouts.app')
@section('styles')
<link href="{{ asset('css/progetti/view.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row margin-bottom-20">
        <div class="col-md-6 text-align-center logo">
            <img src="{{ empty($progetto->logo_base64) ? '/public/img/no-image-available.png' : $progetto->logo_base64 }}"/>
        </div>
        <div class="col-md-6">
            <h2>{{ $progetto->nome }}</h2>
            <div class="oggetto well">{{ $progetto->oggetto }}</div>
            @can('invite', $progetto)
                <div class="inline"><button id="invita" class="btn btn-primary" data-toggle="modal" data-target="#modal-form">Invita a collaborare</button></div>
            @endcan
            @can('update', $progetto)
                <div class="inline"><a href="/progetti/edit-progetto?id={{ $progetto->id }}" id="modifica" class="btn btn-success">Modifica</a></div>
            @endcan
            @can('delete', $progetto)
                <div class="inline"><a href="#" id="elimina" class="btn btn-danger inline">Elimina</a></div>
            @endcan
        </div>
    </div><div class="row">
        <div class="col-md-12">
        <div class="well">
            {!! $progetto->descrizione !!}
        </div>
        </div>
    </div>
    @include('chat', ['chat' => $progetto->chat])
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

$(document).ready(function() {
    
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
                    swal({title:"Fatto!", text:"Progetto eliminato con successo", type:"success", onClose: function(){window.location.href = "/progetti/view-progetto?id="+data.progettoid;}});
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
    
});
</script>
@endsection