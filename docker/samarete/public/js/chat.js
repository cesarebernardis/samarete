function chat_addMessage(chatid, message) {
    $('#chat-'+chatid+' ul.chat').append('\
        <li class="left clearfix message" data-id="'+message.id+'">\
          <div class="chat-body clearfix">\
            <div class="header">\
              <strong class="primary-font">'+message.autore+'</strong>\
              <small class="pull-right text-muted">\
                <i class="fa fa-clock-o fa-fw"></i> '+message.data+'\
              </small>\
            </div>\
            <p>'+message.testo+'</p>\
          </div>\
         </li>\
    ');
}

function chat_update(chatid) {
    $.ajax({
            url: '/chat/update-chat',
            method: "post",
            data: { id: chatid },
            success: function(data) {
                var messages = $('div#chat-'+chatid+' li.message');
                var start = -1;
                data.messaggi.forEach(function(message, i){
                    if(start < 0 && message.id != parseInt($(messages[i]).attr("data-id"))){
                        start = i;
                    }
                });
                
                if(start < 0) return;
                
                for(i = start; i < data.messaggi.length; i++){
                    chat_addMessage(chatid, data.messaggi[i]);
                }
                $("#chat-"+chatid+" div.panel-body").scrollTop($("#chat-"+chatid+" div.panel-body")[0].scrollHeight);
            }
        });
}