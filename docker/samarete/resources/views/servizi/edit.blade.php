@extends('layouts.default')

@section('styles')
<link href="{{ asset('css/servizi/edit.css?v='.time()) }}" rel="stylesheet">
@endsection

@section('content')
    <div class="row margin-bottom-20 border-bottom-thin">
        <div class="col-md-12 text-align-center"><h2 class="title">{{ $servizio ? 'Modifica' : 'Nuovo' }} Servizio</h2></div>
    </div>
    <form class="form-horizontal" id="servizio">
    <div class="row">
        <div class="col-md-12">
            {{ csrf_field() }}
                      <input type="hidden" class="form-control" id="id" name="id" value="{{ $servizio ? $servizio->id : '' }}">
                      <input type="hidden" class="form-control" id="creatore_id" name="creatore_id" value="{{ $associazione->id }}">
                      <div class="form-group">
                        <label class="control-label col-sm-4" for="nome">Nome*: </label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="{{ $servizio ? $servizio->nome : '' }}" autofocus>
                        </div>
                      </div><div class="form-group">
                        <label class="control-label col-sm-4">Logo: </label>
                        <input type="hidden" class="form-control" id="logo" name="logo" value="{{ $servizio ? $servizio->logo : '' }}">
                        <input type="hidden" class="form-control" id="new_logo" name="new_logo" value="">
                        <div class="col-sm-8">
                            <div class="dropzone dz-little" id="upload-logo">
                                <div class="dz-default dz-message">
                                   <span>Trascina il logo o clicca per selezionarlo</span>
                                </div>
                            </div>
                        </div>
                      </div><div class="form-group">
                        <label class="control-label col-sm-4" for="oggetto">Oggetto: </label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="oggetto" name="oggetto" placeholder="Oggetto" value="{{ $servizio ? $servizio->oggetto : '' }}">
                        </div>
                      </div><div class="form-group">
                        <label class="control-label col-sm-4" for="descrizione">Descrizione: </label>
                        <div class="col-sm-8">
                          <textarea class="form-control tinymce" id="descrizione" name="descrizione" placeholder="Descrizione" rows="8">{!! $servizio ? $servizio->descrizione : '' !!}</textarea>
                        </div>
                      </div><div class="form-group">
                        <label class="control-label col-sm-4" for="luogo">Luogo: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="luogo" name="luogo" value="{{ $servizio ? $servizio->luogo : '' }}"/>
                            <div id="luogo-map"></div>
                        </div>
                      </div>
                      
                      <div class="giorni">
                          <div class="form-group">
                              <label class="control-label col-sm-4" for="descrizione"></label>
                              <div class="col-sm-8 border-bottom-thin">
                                  <h4>Durata Servizio</h4>
                              </div>
                          </div>
                          <div class="form-group">
                          <div class="col-sm-4"></div>
                          <div class="col-sm-8">
                            La durata del servizio si basa sulla combinazione tra le informazioni che verranno inserite nel form sottostante.
                            I giorni di erogazione del servizio verranno automaticamente replicati secondo quanto specificato alla voce <i>Periodicit&agrave;</i>
                            a partire dal <i>Giorno 1</i> fino alla <i>Data fine</i> inserita.
                          </div>
                          </div>
                          <div class="form-group">
                                <label class="control-label col-sm-4" for="periodicita">Periodicit&agrave;*: </label>
                                <div class="col-sm-4">
                                <select class="custom-select form-control" name="periodicita" id="periodicita">
                                        <option value="Nessuna" maxdays="100" selected>Nessuna</option>
                                        <option value="Giornaliera" maxdays="1">Giornaliera</option>
                                        <option value="Settimanale" maxdays="7">Settimanale</option>
                                        <option value="Quattordicinale" maxdays="14">Quattordicinale</option>
                                        <option value="Mensile" maxdays="31">Mensile</option>
                                        <option value="Bimestrale" maxdays="62">Bimestrale</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group">
                                    <label class="control-label col-sm-4" for="data_fine">Data fine*: </label>
                                    <div class="col-sm-4">
                                      <div class="input-group date" id="data_fine">
                                        <input type="text" name="data_fine" class="form-control data" />
                                        <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                      </div>
                                    </div>
                            </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-sm-4" for="descrizione"></label>
                          <div class="col-sm-4">
                              <i class="fa fa-1_5 fa-plus-circle green-text hover-cursor-pointer" onclick="addDay()"></i>
                              <i class="fa fa-1_5 fa-minus-circle red-text hover-cursor-pointer" onclick="removeDay()"></i>
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
@endsection

@section('scripts')

<script type="text/javascript">
var map;
var autocomplete;
var marker;
                                
function update_map() {
    
    var place = autocomplete.getPlace();
    if(place.geometry){
        marker.setVisible(false);
        if (place.geometry.viewport) {
          map.fitBounds(place.geometry.viewport);
        } else {
          map.setCenter(place.geometry.location);
          map.setZoom(15);
        }
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
    }
                                  
}

function initializeMaps() {

    map = new google.maps.Map(document.getElementById('luogo-map'), {
        center: new google.maps.LatLng(SAMARATE_LAT, SAMARATE_LNG),
        zoom: 15,
    });
                                    
    autocomplete = new google.maps.places.Autocomplete(
        (document.getElementById('luogo')),
        {types: ['geocode']},
    );
                                    
    autocomplete.addListener('place_changed', update_map);
    
    marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, 0)
    });

}

var logoDropzone = new Dropzone("div#upload-logo", {
		paramName: "file", 
        url: "/file/upload",
		acceptedFiles: "image/*",
		addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
		removedfile: function(file) {
            if($("#new_logo").val()){
                var fileid = $("#new_logo").val();
            }else{
                $("#logo").val("");
            }
            if(fileid){
                $.ajax({
                    type: 'POST',
                    url: '/file/delete-tmp',
                    data: {id: fileid}
                });
                $("#new_logo").val("");
            }
            $("div#upload-logo .dz-message span").show();
    		return file.previewElement != null ? file.previewElement.parentNode.removeChild(file.previewElement) : void 0;
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

function addDay(){
    var n = $("div.giorni .giorno").length + 1;
    /*var maxdays = parseInt($('#periodicita option:selected').attr('maxdays'));
    if(maxdays < n){
        swal("Attenzione!", "Non puoi inserire più di "+maxdays+" giorni per la periodicità selezionata", "warning");
        return;
    }*/
    var id = 'giorno_'+n;
    var html = '\
        <div class="form-group" id="'+id+'">\
          <label class="control-label col-sm-4" for="descrizione">Giorno '+n+': </label>\
            <div class="col-sm-4">\
              <div class="col-md-12">\
                  <div class="input-group date giorno">\
                    <input type="text" name="giorno[data][]" class="form-control data" />\
                    <span class="input-group-addon">\
                      <span class="glyphicon glyphicon-calendar"></span>\
                    </span>\
                  </div>\
              </div>\
              <div class="col-sm-6">Da\
                  <div class="input-group date da">\
                    <input type="text" name="giorno[da][]" class="form-control da" />\
                    <span class="input-group-addon">\
                      <span class="glyphicon glyphicon-time"></span>\
                    </span>\
                  </div>\
              </div>\
              <div class="col-sm-6">A\
                  <div class="input-group date a">\
                    <input type="text" name="giorno[a][]" class="form-control a" />\
                    <span class="input-group-addon">\
                      <span class="glyphicon glyphicon-time"></span>\
                    </span>\
                  </div>\
              </div>\
            </div>\
            <div class="col-sm-4">\
                Descrizione:\
                <div class="form-group">\
                    <div class="col-sm-12">\
                       <textarea class="form-control descrizione" name="giorno[descrizione][]" rows="2" maxlength="200"></textarea>\
                    </div>\
                </div>\
            </div>\
        </div>\
    ';
    $(".giorni").append(html);
    $("#"+id+" .giorno").datetimepicker({
        locale: 'it',
        minDate: moment(),
        defaultDate: moment().add(1, 'day'),
        format: "DD/MM/YYYY",
    });
    $("#"+id+" .da").datetimepicker({
        locale: 'it',
        format: "LT",
    });
    $("#"+id+" .a").datetimepicker({
        locale: 'it',
        format: "LT",
        useCurrent: false,
    });
    
    $("#"+id+" .da").on("dp.change", function (e) {
        $("#"+id+" .a").data("DateTimePicker").minDate(e.date);
    });
    $("#"+id+" .a").on("dp.change", function (e) {
        $("#"+id+" .da").data("DateTimePicker").maxDate(e.date);
    });
}

function removeDay(){
    var n = $("div.giorni .giorno").length;
    var id = "#giorno_"+parseInt(n);
    if($(id)) $(id).remove();
}

$(document).ready(function() {
    
    $('div#main_navigation_container ul#main_menu li#menu-item-servizi').addClass('active current-menu-parent');
    
    /*$("#data_inizio").datetimepicker({
        locale: 'it',
        minDate: moment(),
        defaultDate: moment().add(1, 'day'),
        format: "DD/MM/YYYY",
    });*/
    
    $("#data_fine").datetimepicker({
        locale: 'it',
        minDate: moment().add(1, 'day'),
        format: "DD/MM/YYYY",
    });
    
    @if (!empty($servizio))

        <?php
        $i = 1;
        foreach($servizio->giorni as $giorno){
            $from = date_create($giorno->giorno.' '.$giorno->da) ;
            $to = date_create($giorno->giorno.' '.$giorno->a) ;
            echo "addDay();\n";
            echo "$('#giorno_".$i." .data').val('".date_format($from, 'd/m/Y')."');\n";
            echo "$('#giorno_".$i." .da').val('".date_format($from, 'H:i')."');\n";
            echo "$('#giorno_".$i." .a').val('".date_format($to, 'H:i')."');\n";
            echo "$('#giorno_".$i." .descrizione').val('".$giorno->descrizione."');\n";
            $i++;
        }
        ?>

        $.ajax({
           url: '/servizi/get-logo',
           method: "post",
           data: {id: {{ $servizio->id }} },
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
           },
           error: function() {
               swal("Errore!", "Errore durante il caricamento del logo", "error");
           }
       });
    @else
        addDay();
    @endif
    
    var form = $('form#servizio').validate({
        rules: {
            nome: {
                required: true,
            },
            periodicita: {
                required: true,
            },
            data_fine: {
                required: true,
            },
        }, 
        messages: {
            nome: {
                required: "Inserisci un nome",
            },
            periodicita: {
                required: "Inserisci una periodicit&agrave;",
            },
            data_fine: {
                required: "Inserisci una data fine",
            },
        },
        submitHandler: function(form) {
            
        }
    });
    
    $("#servizio button.submit").click(function(){
        tinyMCE.triggerSave();
        if(!$('form#servizio').valid())
            return;
        var data = $("#servizio").serializeArray();
        $.ajax({
           url: '/servizi/save-servizio',
           method: "post",
           data: data,
           success: function(data) {
               swal({title:"Fatto!", text:"Salvataggio riuscito", type:"success", onClose: function(){window.location.href = "/servizi/view-servizio?id="+data.servizioid;}});
           },
           error: function() {
               swal("Errore!", "Errore durante il salvataggio del servizio", "error");
           }
       });
    });
    
    $("#servizio button.cancel").click(function(){ window.location.href = "/servizi"; });
});
</script>
@endsection