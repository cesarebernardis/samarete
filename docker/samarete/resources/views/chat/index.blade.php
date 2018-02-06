@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/chat/index.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    @if (!empty($mainchat))
        <div class="row">
            @include('chat', ['titolo' => 'Chat pi&ugrave; recente: '.$mainchat->partecipanti(), 'chat' => $mainchat])
        </div>
    @endif
    <div class="row itemlist">
    @if (empty($chats))
        <div class="well"><h2>Nessuna chat trovata</h2></div>
    @else
        <h2>Chat recenti</h2>
        <div class="chat-panel panel panel-default">
        <div class="panel-body">
           <ul class="chat">
            @foreach ($chats as $chat)
                <a href="/chat/?id={{ $chat->id }}">
                <li class="left clearfix">
                     <span class="chat-img pull-left">
                         <img src="/public/img/user-icon.png" alt="Avatar Associazione" class="img-circle">
                     </span>
                     <div class="chat-body clearfix">
                         <div class="header">
                              <strong class="primary-font">{{ $chat->partecipanti() }}</strong>
                              <small class="pull-right text-muted">
                                   <i class="fa fa-clock-o fa-fw"></i> {{ empty($chat->ultimo_messaggio()) ? 'Nessun invio' : $chat->ultimo_messaggio()->data->diffForHumans() }}
                              </small>
                         </div>
                         <p>{{ empty($chat->ultimo_messaggio()) ? 'Nessun messaggio' : $chat->ultimo_messaggio()->testo }}</p>
                     </div>
                </li>
                </a>
            @endforeach
            </ul>
        </div>
        </div>
    @endif
    </div>
    @can('create', Samarete\Models\Chat::class)
    <div class="row">
        <div class="col-md-10 col-xs-12">
            <select class="form-control" name="associazioni[]" id="associazioni" multiple="multiple">
                @foreach($associazioni as $associazione)
                  @if($associazione->id != Auth::user()->associazione()->id)
                    <option value="{{ $associazione->id }}">{{ empty($associazione->acronimo) ? $associazione->nome : $associazione->acronimo }}</option>
                  @endif
                @endforeach
            </select>
        </div>
        <div class="col-md-2 col-xs-12">
            <button id="start-chat" class="btn btn-primary">Inizia una nuova chat</button>
        </div>
    </div>
    @endcan
</div>
@endsection

@section('scripts')
<script type="text/javascript">

$(document).ready(function() {
    
    $('#associazioni').select2();
    
    $('#start-chat').click(function(){
        
        var associazioni = $('#associazioni').val();
        if(!associazioni) return;
        
        $.ajax({
           url: '/chat/create-chat',
           method: "post",
           data: { associazioni: associazioni },
           success: function(data) {
               window.location.href = "/chat/?id="+data.chat_id;
           },
           error: function() {
               swal("Errore!", "Errore durante la creazione della chat", "error");
           }
       });
    });
    
});

</script>
@endsection