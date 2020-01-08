@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/servizi/index.css?v='.time()) }}" rel="stylesheet">
@endsection

@section('content')
    <section id="titlebar" class="titlebar titlebar-type-solid border-yes titlebar-scheme-light titlebar-alignment-center titlebar-valignment-center titlebar-size-large enable-hr-yes" data-height="350" data-rs-height="yes">
            <div class="parallax-image parallax-section-no" style="background-image: url('{{ asset('img/servizi/header.jpg') }}');"></div>
            <div class="section-overlay"></div>
            <div class="titlebar-wrapper" style="height: 350px; min-height: 350px;">
                <div class="titlebar-content">
                    <div class="container">
                        <div class="row-fluid">
                            <div class="row-fluid">
                                <div class="titlebar-heading">
                                    <h1><span>SERVIZI</span></h1>
                                    <div class="hr hr-border-primary double-border border-small">
                                        <span></span>
                                    </div>
                                    <div class="titlebar-subcontent">
                                        Tutte le attivit&agrave; che le associazioni<br/>
                                        propongono periodicamente nella nostra citt&agrave;
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    
    <section class="section content-box section-border-no section-bborder-no section-height-content section-bgtype-image section-fixed-background-no section-bgstyle-stretch section-triangle-no triangle-location-top parallax-section-no section-overlay-no section-overlay-dot-no " style="padding-top:50px;padding-bottom:50px;background-color:#ffffff;" data-video-ratio="" data-parallax-speed="1">
        <div class="section-overlay" style=""></div>
        <div class="container section-content">
            <div class="row margin-bottom-20">
                <div class="left col-md-8"></div>
                <div class="left col-md-4 col-xs-12">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Cerca..." id="query-cerca" size="50" maxlength="50" value="{{ empty($query) ? '' : $query }}"/>
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" id="submit-cerca">
                            <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div> 
        </div>
        <div class="container section-content margin-top-20">
            <div class="row-fluid">
                <div class="row-fluid equal-cheight-no element-padding-large element-vpadding-default">
                    @if (empty($servizi))
                        <h2>Nessun servizio trovato</h2>
                    @else
                        @foreach ($servizi as $servizio)
                        <div class="section-column span6" style="">
                            <div class="inner-content content-box textnone" style="padding:0px">
                                <div id="feature_boxes_container_617024539" class="clearfix">
                                @if ($loop->index % 2)
                                    <div id="feature_boxes_18" class="row-fluid style1 background-shadow-no feature_boxes box-style2 enable-hr-yes element-vpadding- hr-type-tiny hr-color-dark hr-style-double large-size element-inner-vertical-padding-medium element-inner-horizental-padding-medium icon-side-left iconbox-style2 align-content-center-no align-icon-center-no columns-1 crease-background-no content-box default element-padding-medium ">
                                        <div class="span">
                                            <div class="inner-content animate-when-visible fadeInRight start-animation" data-animation-delay="0" data-animation-effect="fadeInRight">
                                                <div class="feature_box">
                                                    <span class="brad-icon" data-animation-delay="0" data-animation-effect="fadeInRight">
                                                    <a href="/servizi/view-servizio?id={{ $servizio->id }}"><img src="{{ empty($servizio->categoria->icona) ? '/public/img/no-image-available.png' : '/public/img/catservizi/'.$servizio->categoria->icona }}"/></a>
                                                    </span>
                                                    <div class="heading">
                                                        <div class="heading-content"><h4>{{ $servizio->nome }}</h4></div>
                                                        <div class="hr"><span></span></div>
                                                    </div>
                                                    <div class="feature-content">{{ $servizio->oggetto }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div id="feature_boxes_18" class="row-fluid style1 background-shadow-no feature_boxes box-style2 enable-hr-yes element-vpadding- hr-type-tiny hr-color-dark hr-style-double large-size element-inner-vertical-padding-medium element-inner-horizental-padding-medium icon-side-right iconbox-style2 align-content-center-no align-icon-center-no columns-1 crease-background-no content-box default element-padding-medium ">
                                        <div class="span">
                                            <div class="inner-content animate-when-visible fadeInLeft start-animation" data-animation-delay="0" data-animation-effect="fadeInLeft">
                                                <div class="feature_box">
                                                    <span class="brad-icon" data-animation-delay="0" data-animation-effect="fadeInLeft">
                                                    <a href="/servizi/view-servizio?id={{ $servizio->id }}"><img src="{{ empty($servizio->categoria->icona) ? '/public/img/no-image-available.png' : '/public/img/catservizi/'.$servizio->categoria->icona }}"/></a>
                                                    </span>
                                                    <div class="heading">
                                                        <div class="heading-content"><h4>{{ $servizio->nome }}</h4></div>
                                                        <div class="hr"><span></span></div>
                                                    </div>
                                                    <div class="feature-content">{{ $servizio->oggetto }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        @can('create', Samarete\Models\Servizio::class)
            <div class="row">
                <div class="col-md-12">
                    <a href="/servizi/edit-servizio"><button class="button button_default button_color_default button_default border-radius-default icon-align-left">Crea nuovo servizio</button></a>
                </div>
            </div>
        @endcan
        </div>
    </section>
@endsection

@section('scripts')
<script type="text/javascript">

$(document).ready(function(){
    
    $('div#main_navigation_container ul#main_menu li#menu-item-servizi').addClass('active current-menu-parent');
    
    var originalQuery = "{{ $query }}";
    
    function relocate(){
        var query = $("input#query-cerca").val();
        if(!query && !originalQuery) return;
        window.location.replace("/servizi/?search="+query);
    }
    
    $("button#submit-cerca").click(relocate);
    
    $('input#query-cerca').keypress(function(event) {
        if (event.keyCode == 13 || event.which == 13) {
            relocate();
        }
    });
    
});

</script>
@endsection