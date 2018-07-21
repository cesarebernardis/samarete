@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/progetti/index.css') }}" rel="stylesheet">
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
                                    <h1><span>PROGETTI</span></h1>
                                    <div class="hr hr-border-primary double-border border-small">
                                        <span></span>
                                    </div>
                                    <div class="titlebar-subcontent">
                                        Raccogliamo le iniziative che le associazioni<br/>
                                        vogliono proporre nel prossimo futuro
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
            <div class="row itemlist">
            @if (empty($progetti))
                <h2>Nessun progetto trovato</h2>
            @else
                @php($row = 'left')
                @foreach ($progetti as $progetto)
                    <section id="section_1612688709" class="section content-box full-width section-border-no section-bborder-no section-height-content section-bgtype-image section-fixed-background-no section-bgstyle-stretch section-triangle-no triangle-location-top parallax-section-no section-overlay-no section-overlay-dot-no " style="padding-top:0;padding-bottom:0;background-color:#ffffff;" data-video-ratio="" data-parallax-speed="1">
                    <div class="section-overlay" style=""></div>
                    <div class="container section-content">
                        <div class="row-fluid">
                            <div class="row-fluid equal-cheight-yes element-padding-medium element-vpadding-no">
                                <div class="section-column span6" style="">
                                    <div class="inner-content content-box textnone" style="padding:0px;">
                                        <div class="single-image-container img-align-center">
                                            <div class="single-image animate-when-visible fadeInLeft start-animation" data-animation-delay="0" data-animation-effect="fadeInLeft">
                                                <img src="{{ empty($progetto->logo_base64) ? asset('img/no-image-available.png') : $progetto->logo_base64 }}" class="attachment-full" alt="{{ $progetto->nome }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="section-column span6" style="">
                                    <div class="inner-content content-box textnone" style="padding:40px 15px;">
                                        <h3 class="title textleft default bw-2px dh-2px divider-dark bc-dark dw-default color-default" style="margin-bottom:0px">
                                            <span>{{ $progetto->nome }}</span>
                                        </h3>
                                        <div class="hr border-small dh-2px alignleft hr-border-primary" style="margin: 15px 0px;"><span></span></div>
                                        <div class="column-text"></div>
                                        <h4 class="title textleft default bw-2px dh-2px divider-dark bc-dark dw-default color-default" style="margin-bottom:0px">{{ $progetto->oggetto }}</h4>
                                        <div class="break-text" style="height:160px;">{{ strip_tags($progetto->descrizione) }}</div>
                                        <a id="brad_button_475111020" class="button button_default button_color_default button_default icon-align-right" title="Scopri di piu" href="/progetti/view-progetto?id={{ $progetto->id }}">
                                            <span>Scopri di pi&ugrave;</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </section>
                    @php($row = ($row == 'left') ? 'right' : 'left')
                @endforeach
            @endif
            </div>
            @can('create', Samarete\Models\Progetto::class)
            <div class="row">
                <div class="col-md-12">
                    <a href="/progetti/edit-progetto"><button class="btn btn-primary">Crea nuovo progetto</button></a>
                </div>
            </div>
            @endcan
        </div>
    </section>
@endsection

@section('scripts')
<script type="text/javascript">

$(document).ready(function(){
    
    $('div#main_navigation_container ul#main_menu li#menu-item-progetti').addClass('active current-menu-parent');
    
    var originalQuery = "{{ $query }}";
    
    function relocate(){
        var query = $("input#query-cerca").val();
        if(!query && !originalQuery) return;
        window.location.replace("/progetti/?search="+query);
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