
<div class="row">
    <div class="col-md-12">
        <div id="chat-{{ $chat->id }}" class="chat-panel panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-comments fa-fw"></i> Chat
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <ul class="chat">
                                @foreach($chat->messaggi as $messaggio)
                                <li class="left clearfix message" data-id="{{ $messaggio->id }}">
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font">{{ empty($messaggio->autore->acronimo) ? $messaggio->autore->nome : $messaggio->autore->acronimo }}</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> {{ $messaggio->data->formatLocalized('%d/%m/%Y %H:%M') }}
                                            </small>
                                        </div>
                                        <p>{{ $messaggio->testo }}</p>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- /.panel-body -->
                        <div class="panel-footer">
                            <div class="input-group">
                                <input id="btn-input" type="text" class="form-control input-sm" placeholder="Scrivi...">
                                <span class="input-group-btn">
                                    <button class="btn btn-warning btn-sm" id="btn-chat">
                                        Invia
                                    </button>
                                </span>
                            </div>
                        </div>
                        <!-- /.panel-footer -->
                    </div>
        
    </div>
</div>

<script type="text/javascript" src="{{ asset('js/chat.js') }}"></script>
<script>

$(document).ready(function(){
    
    setInterval(function(){ chat_update({{ $chat->id }}); }, 20000);
    
    $('#chat-{{ $chat->id }} input#btn-input').keypress(function(e) {
        if(e.which == 13) {
            $('#chat-{{ $chat->id }} button#btn-chat').click();
        }
    });
    
    $('#chat-{{ $chat->id }} button#btn-chat').click(function(){
        var messaggio = $('#chat-{{ $chat->id }} input#btn-input').val().trim();
        if(!messaggio) return;
        var d = {
            chat: {{ $chat->id }},
            messaggio: $('#chat-{{ $chat->id }} input#btn-input').val(),
        }
        $.ajax({
               url: '/chat/save-message',
               method: "post",
               data: d,
               success: function(data) {
                    chat_update({{ $chat->id }});
                    $('#chat-{{ $chat->id }} input#btn-input').val("");
               },
               error: function() {
                   swal("Errore!", "Errore durante l'invio del messaggio", "error");
               }
        });
    });
    
    $("#chat-{{ $chat->id }} div.panel-body").scrollTop($("#chat-{{ $chat->id }} div.panel-body")[0].scrollHeight);
    
});

</script>