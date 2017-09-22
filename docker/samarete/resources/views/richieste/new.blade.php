@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/richieste/new.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row margin-bottom-20 border-bottom-thin">
        <div class="col-md-12 text-align-center"><h2 class="title">Nuova Richiesta</h2></div>
    </div>
    <form class="form-horizontal" id="richiesta">
    <div class="row">
        <div class="col-md-12">
            {{ csrf_field() }}
                      <div class="form-group">
                        <label class="control-label col-sm-4" for="contatto_1">Contatto 1*: </label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="contatto_1" name="contatto_1" placeholder="Contatto" autofocus>
                        </div>
                      </div><div class="form-group">
                        <label class="control-label col-sm-4" for="contatto_2">Contatto 2: </label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="contatto_2" name="contatto_2" placeholder="Contatto" >
                        </div>
                      </div><div class="form-group">
                        <label class="control-label col-sm-4" for="oggetto">Oggetto*: </label>
                        <div class="col-sm-8">
                          <input type="textarea" class="form-control" id="oggetto" name="oggetto" placeholder="Oggetto">
                        </div>
                      </div><div class="form-group">
                        <label class="control-label col-sm-4" for="testo">Descrizione*: </label>
                        <div class="col-sm-8">
                          <textarea class="form-control" id="testo" name="testo" placeholder="Descrizione" rows="4"></textarea>
                        </div>
                      </div><div class="form-group">
                        <label class="control-label col-sm-4" for="associazioni">Associazioni: </label>
                        <div class="col-sm-6">
                          <select class="form-control" id="associazioni" name="associazioni[]" multiple="multiple">
                          @foreach($associazioni as $associazione)
                            <option value="{{ $associazione->id }}">{{ $associazione->nome }}</option>
                          @endforeach
                          </select>
                        </div>
                        <label class="control-label col-sm-1" for="associazioni">Globale: </label>
                        <div class="col-sm-1">
                          <input type="checkbox" name="globale" id="globale" value="1"/>
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

$(document).ready(function() {
    
    $('#associazioni').select2();
    
    $('#globale').change(function(){
        if(this.checked){
            $('#associazioni').prop('disabled', 'disabled');
        }else{
            $('#associazioni').prop('disabled', '');
        }
    });
    
    var form = $('form#richiesta').validate({
        rules: {
            contatto_1: {
                required: true,
            },
            oggetto: {
                required: true,
            },
            testo: {
                required: true,
            },
        }, 
        messages: {
            contatto_1: {
                required: "Inserisci un contatto",
            },
            oggetto: {
                required: "Inserisci un oggetto",
            },
            testo: {
                required: "Inserisci una descrizione",
            },
        },
        submitHandler: function(form) {
            
        }
    });
    
    $("#richiesta button.submit").click(function(){
        if(!$('form#richiesta').valid())
            return;
        var data = $("#richiesta").serializeArray();
        $.ajax({
           url: '/richieste/save-richiesta',
           method: "post",
           data: data,
           success: function(data) {
               swal({title:"Fatto!", text:"Salvataggio riuscito", type:"success", onClose: function(){window.location.href = "/";}});
           },
           error: function() {
               swal("Errore!", "Errore durante il salvataggio dell'richiesta", "error");
           }
       });
    });
    
    $("#richiesta button.cancel").click(function(){ window.location.href = "/"; });
});
</script>
@endsection