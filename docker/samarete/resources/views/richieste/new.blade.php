@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/richieste/new.css') }}" rel="stylesheet">
@endsection

@section('content')
        <section id="titlebar" class="titlebar titlebar-type-solid border-yes titlebar-scheme-light titlebar-alignment-center titlebar-valignment-center titlebar-size-large enable-hr-yes" data-height="350" data-rs-height="yes">
            <!-- <div class="parallax-image parallax-section-no"></div> -->
            <div class="section-overlay"></div>
            <div class="titlebar-wrapper" style="height: 350px; min-height: 350px;">
                <div class="titlebar-content">
                    <div class="container">
                        <div class="row-fluid">
                            <div class="row-fluid">
                                <div class="titlebar-heading">
                                    <h1><span>CHIEDI AIUTO</span></h1>
                                    <div class="hr hr-border-primary double-border border-small">
                                        <span></span>
                                    </div>
                                    <div class="titlebar-subcontent">
                                        Compilando questo form potrai inoltrare la tua richiesta<br/>alle associazioni che possono aiutarti
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="section_1737668853" class="section content-box section-border-no section-bborder-no section-height-content section-bgtype-image section-fixed-background-no section-bgstyle-stretch section-triangle-no triangle-location-top parallax-section-no section-overlay-no section-overlay-dot-no " data-video-ratio="" data-parallax-speed="1">
            <div class="section-overlay" style=""></div>
            <div class="container section-content">
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
                                      <textarea class="fullwidth" id="oggetto" name="oggetto" placeholder="Oggetto" rows="2"></textarea>
                                    </div>
                                  </div><div class="form-group">
                                    <label class="control-label col-sm-4" for="testo">Descrizione*: </label>
                                    <div class="col-sm-8">
                                      <textarea class="fullwidth" id="testo" name="testo" placeholder="Descrizione" rows="4"></textarea>
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
                                    <div class="col-sm-2">
                                        <label class="control-label col-sm-8" for="associazioni">Globale: </label>
                                        <div class="col-sm-4">
                                          <input type="checkbox" name="globale" id="globale" value="1" style="margin-top:13px;"/>
                                        </div>
                                    </div>
                                  </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-4 text-align-right">
                        <a class="button button_default button_color_default button_default border-radius-default icon-align-left submit" title="Invia" href="#"><span>Invia</span></a>
                        <a class="button button_default button_color_black button_default border-radius-default icon-align-left cancel" title="Annulla" href="#"><span>Annulla</span></a>
                    </div>
                </div>
                </form>
            </div>
        </section>
@endsection

@section('scripts')
<script type="text/javascript">

$(document).ready(function() {
    
    $('div#main_navigation_container ul#main_menu li#menu-item-richieste-new').addClass('active current-menu-parent');
    
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
    
    $("#richiesta a.submit").click(function(){
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
    
    $("#richiesta a.cancel").click(function(){ window.location.href = "/"; });
});
</script>
@endsection