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
            @can('edit', $progetto)
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
@endsection

@section('scripts')
<script type="text/javascript">

$(document).ready(function() {
    
    
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
});
</script>
@endsection