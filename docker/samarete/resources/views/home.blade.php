@extends('layouts.app')


@section('styles')
<link href="{{ asset('css/home.css?v='.time()) }}" rel="stylesheet">
@endsection

@section('content')

<!-- Rev Slider Start -->
        <div id="rev_slider_1_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" style="margin:0px auto;background-color:#E9E9E9;padding:0px;margin-top:0px;margin-bottom:0px;max-height:600px;">
            <!-- START REVOLUTION SLIDER 4.6.5 fullwidth mode -->
            <div id="rev_slider_1_1" class="rev_slider fullwidthabanner" style="display:none;max-height:600px;height:600px;">
                <ul>
                    <!-- SLIDE  -->
                    <li data-transition="fade" data-slotamount="7" data-masterspeed="300" data-saveperformance="off">
                        <!-- MAIN IMAGE -->
                        <img src="{{ asset('components/aperio-theme/upload/shutterstock_178724276.jpg') }}" alt="shutterstock_178724276" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                        <!-- LAYERS -->
                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption brad-heading sfb tp-resizeme" data-x="25" data-y="center" data-voffset="-70" data-speed="500" data-start="500" data-easing="Power3.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="300" style="z-index: 5; max-width: auto; max-height: auto; white-space: nowrap;">
                            SAMARETE
                        </div>
                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption brad-sub-heading sfb tp-resizeme" data-x="25" data-y="center" data-voffset="20" data-speed="500" data-start="1000" data-easing="Power3.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="300" style="z-index: 6; max-width: auto; max-height: auto; white-space: nowrap;">
                            Il portale della comunità, per la comunità
                        </div>
                        <!-- LAYER NR. 3 -->
                        <div class="tp-caption brad-buttons sfb tp-resizeme" data-x="18" data-y="center" data-voffset="105" data-speed="500" data-start="1500" data-easing="Power3.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="300" style="z-index: 7; max-width: auto; max-height: auto; white-space: nowrap;">
                            <a href="#" class="button button_large button_green">Chi siamo</a><a href="/richieste/new" class="button button_large button_alternate">Chiedi aiuto</a>
                        </div>
                    </li>
                    <!-- SLIDE  -->
                    <li data-transition="fade" data-slotamount="7" data-masterspeed="300" data-saveperformance="off">
                        <!-- MAIN IMAGE -->
                        <img src="{{ asset('components/aperio-theme/upload/shutterstock_178724276.jpg') }}" alt="shutterstock_178724276" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                        <!-- LAYERS -->
                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption brad-heading sfb tp-resizeme" data-x="25" data-y="center" data-voffset="-70" data-speed="500" data-start="500" data-easing="Power3.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="300" style="z-index: 5; max-width: auto; max-height: auto; white-space: nowrap;">
                            SAMARETE
                        </div>
                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption brad-sub-heading sfb tp-resizeme" data-x="25" data-y="center" data-voffset="20" data-speed="500" data-start="1000" data-easing="Power3.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="300" style="z-index: 6; max-width: auto; max-height: auto; white-space: nowrap;">
                            Il portale della comunità, per la comunità
                        </div>
                        <!-- LAYER NR. 3 -->
                        <div class="tp-caption brad-buttons sfb tp-resizeme" data-x="18" data-y="center" data-voffset="105" data-speed="500" data-start="1500" data-easing="Power3.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="300" style="z-index: 7; max-width: auto; max-height: auto; white-space: nowrap;">
                            <a href="#" class="button button_large button_green">Chi siamo</a><a href="/richieste/new" class="button button_large button_alternate">Chiedi aiuto</a>
                        </div>
                    </li>
                    <!-- SLIDE  -->
                    <li data-transition="fade" data-slotamount="7" data-masterspeed="300" data-saveperformance="off">
                        <!-- MAIN IMAGE -->
                        <img src="{{ asset('components/aperio-theme/upload/shutterstock_178724276.jpg') }}" alt="shutterstock_178724276" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                        <!-- LAYERS -->
                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption brad-heading sfb tp-resizeme" data-x="25" data-y="center" data-voffset="-70" data-speed="500" data-start="500" data-easing="Power3.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="300" style="z-index: 5; max-width: auto; max-height: auto; white-space: nowrap;">
                            SAMARETE
                        </div>
                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption brad-sub-heading sfb tp-resizeme" data-x="25" data-y="center" data-voffset="20" data-speed="500" data-start="1000" data-easing="Power3.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="300" style="z-index: 6; max-width: auto; max-height: auto; white-space: nowrap;">
                            Il portale della comunità, per la comunità
                        </div>
                        <!-- LAYER NR. 3 -->
                        <div class="tp-caption brad-buttons sfb tp-resizeme" data-x="18" data-y="center" data-voffset="105" data-speed="500" data-start="1500" data-easing="Power3.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="300" style="z-index: 7; max-width: auto; max-height: auto; white-space: nowrap;">
                            <a href="#" class="button button_large button_green">Chi siamo</a><a href="/richieste/new" class="button button_large button_alternate">Chiedi aiuto</a>
                        </div>
                    </li>
                </ul>
                <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;">
                </div>
            </div>
        </div>
        <!-- END REVOLUTION SLIDER -->
        <!-- Rev Slider End -->
        
    <div class="fullwidth">
    <section id="section_1300744414" class="section content-box section-border-no section-bborder-no section-height-content section-bgtype-image section-fixed-background-no section-bgstyle-stretch section-triangle-no triangle-location-top parallax-section-no section-overlay-no section-overlay-dot-no "  data-video-ratio="" data-parallax-speed="1">
        <div class="section-overlay" style=""></div>
        <div class="container section-content">
            <div class="row-fluid">
                <div class="row-fluid equal-cheight-no element-padding-default element-vpadding-default">
                    <div class="section-column span12" style="">
                        <div class="inner-content content-box textnone" id="div_c1fb_0">
                            <h2 class="title textcenter default bw-defaultpx dh-defaultpx divider-dark bc-default dw-default color-default" id="h2_c1fb_0"><span>Benvenuti in Samarete</span></h2>
                            <div class="hr border-small dh-2px aligncenter hr-border-primary" id="div_c1fb_1">
                                <span></span>
                            </div>
                            <h6 class="title textcenter default bw-defaultpx dh-defaultpx divider-dark bc-default dw-default color-default" id="h6_c1fb_0">
                            <span>
                            Questo portale nasce con l'intenzione di avvicinare <br/> 
                            i cittadini alle associazioni e agli enti che agiscono sul territorio ogni giorno.<br/>
                            L'obiettivo concordato è chiaro: il bene comune.<br/>
                            </span>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="section_1530575777" class="section content-box section-border-no section-bborder-no section-height-content section-bgtype-image section-fixed-background-no section-bgstyle-stretch section-triangle-no triangle-location-top parallax-section-no section-overlay-no section-overlay-dot-no " style="padding-top:60px;padding-bottom:60px;background-color:#ffffff;" data-video-ratio="" data-parallax-speed="1">
        <div class="section-overlay" style=""></div>
        <!-- <div class="container section-content">-->
            <div class="row-fluid">
                <div class="row-fluid equal-cheight-no element-padding-default element-vpadding-default">
                    <div class="section-column span12" style="">
                        <div class="inner-content content-box textnone" style="padding:0px;">
                            <div id="portfolio_929218575" class="portfolio padding-no">
                                <div class="row-fluid portfolio-items bg-style-white sortable-items portfolio-style1 columns-2 love-it-no enable-hr-no hr-type-tiny hr-color-light hr-style-normal element-padding-no info-style-left element-vpadding-default info-onhover-yes " data-columns="2" data-animation-delay="0" data-animation-effect="" data-masonry-layout="no" style="opacity: 1; position: relative; height: 1081.59px;">
                                    <div class="portfolio-item span scheme-default">
                                        <div class="inner-content">
                                            <div class="image hoverlay">
                                                <a href="/associazioni" target="_self"><img class="" src="/public/img/associazioni.jpeg" alt="Associazioni"></a>
                                                <div class="overlay">
                                                    <div class="overlay-content" link-target="/associazioni">
                                                        <!-- <div class="overlay-icons">
                                                            <a href="/associazioni" target="_self" title="Associazioni" class="lightbox-icon"><i class="fa fa-icon_link"></i></a>
                                                        </div> -->
                                                        <div class="info">
                                                            <h1><a href="/associazioni" target="_self" title="Associazioni">Associazioni</a></h1>
                                                            <div class="hr"><span></span></div>
                                                            <!--<h5><a href="#" rel="tag">Associazioni</a></h5>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portfolio-item span scheme-default">
                                        <div class="inner-content">
                                            <div class="image hoverlay">
                                                <a href="/eventi" target="_self"><img class="" src="/public/img/evento.jpg" alt="Eventi"></a>
                                                <div class="overlay">
                                                    <div class="overlay-content" link-target="/eventi">
                                                        <!-- <div class="overlay-icons">
                                                            <a href="/eventi" target="_self" title="Eventi" class="lightbox-icon"><i class="fa fa-icon_link"></i></a>
                                                        </div> -->
                                                        <div class="info">
                                                            <h1><a href="/eventi" target="_self" title="Eventi">Eventi</a></h1>
                                                            <div class="hr"><span></span></div>
                                                            <!--<h5><a href="#" rel="tag">Eventi</a></h5>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portfolio-item span scheme-default">
                                        <div class="inner-content">
                                            <div class="image hoverlay">
                                                <a href="/progetti" target="_self"><img class="" src="/public/img/progetto.jpg" alt="Progetti"></a>
                                                <div class="overlay">
                                                    <div class="overlay-content" link-target="/progetti">
                                                        <!-- <div class="overlay-icons">
                                                            <a href="/progetti" target="_self" title="Progetti" class="lightbox-icon"><i class="fa fa-icon_link"></i></a>
                                                        </div> -->
                                                        <div class="info">
                                                            <h1><a href="/progetti" target="_self" title="Progetti">Progetti</a></h1>
                                                            <div class="hr"><span></span></div>
                                                            <!--<h5><a href="#" rel="tag">Progetti</a></h5>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portfolio-item span scheme-default">
                                        <div class="inner-content">
                                            <div class="image hoverlay">
                                                <a href="/servizi" target="_self"><img class="" src="/public/img/servizio.jpg" alt="Servizi"></a>
                                                <div class="overlay">
                                                    <div class="overlay-content" link-target="/servizi">
                                                        <!-- <div class="overlay-icons">
                                                            <a href="/servizi" target="_self" title="Servizi" class="lightbox-icon"><i class="fa fa-icon_link"></i></a>
                                                        </div> -->
                                                        <div class="info">
                                                            <h1><a href="/servizi" target="_self" title="Servizi">Servizi</a></h1>
                                                            <div class="hr"><span></span></div>
                                                            <!-- <h5><a href="#" rel="tag">Servizi</a></h5> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- </div> -->
        </section>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
        /******************************************
			-	PREPARE PLACEHOLDER FOR SLIDER	-
		******************************************/
        var setREVStartSize = function() {
            var tpopt = new Object();
            tpopt.startwidth = 1150;
            tpopt.startheight = 600;
            tpopt.container = jQuery('#rev_slider_1_1');
            tpopt.fullScreen = "off";
            tpopt.forceFullWidth = "off";
            tpopt.container.closest(".rev_slider_wrapper").css({
                height: tpopt.container.height()
            });
            tpopt.width = parseInt(tpopt.container.width(), 0);
            tpopt.height = parseInt(tpopt.container.height(), 0);
            tpopt.bw = tpopt.width / tpopt.startwidth;
            tpopt.bh = tpopt.height / tpopt.startheight;
            if (tpopt.bh > tpopt.bw) tpopt.bh = tpopt.bw;
            if (tpopt.bh < tpopt.bw) tpopt.bw = tpopt.bh;
            if (tpopt.bw < tpopt.bh) tpopt.bh = tpopt.bw;
            if (tpopt.bh > 1) {
                tpopt.bw = 1;
                tpopt.bh = 1
            }
            if (tpopt.bw > 1) {
                tpopt.bw = 1;
                tpopt.bh = 1
            }
            tpopt.height = Math.round(tpopt.startheight * (tpopt.width / tpopt.startwidth));
            if (tpopt.height > tpopt.startheight && tpopt.autoHeight != "on") tpopt.height = tpopt.startheight;
            if (tpopt.fullScreen == "on") {
                tpopt.height = tpopt.bw * tpopt.startheight;
                var cow = tpopt.container.parent().width();
                var coh = jQuery(window).height();
                if (tpopt.fullScreenOffsetContainer != undefined) {
                    try {
                        var offcontainers = tpopt.fullScreenOffsetContainer.split(",");
                        jQuery.each(offcontainers, function(e, t) {
                            coh = coh - jQuery(t).outerHeight(true);
                            if (coh < tpopt.minFullScreenHeight) coh = tpopt.minFullScreenHeight
                        })
                    } catch (e) {}
                }
                tpopt.container.parent().height(coh);
                tpopt.container.height(coh);
                tpopt.container.closest(".rev_slider_wrapper").height(coh);
                tpopt.container.closest(".forcefullwidth_wrapper_tp_banner").find(".tp-fullwidth-forcer").height(coh);
                tpopt.container.css({
                    height: "100%"
                });
                tpopt.height = coh;
            } else {
                tpopt.container.height(tpopt.height);
                tpopt.container.closest(".rev_slider_wrapper").height(tpopt.height);
                tpopt.container.closest(".forcefullwidth_wrapper_tp_banner").find(".tp-fullwidth-forcer").height(tpopt.height);
            }
        };
        /* CALL PLACEHOLDER */
        setREVStartSize();
        var tpj = jQuery;
        tpj.noConflict();
        var revapi1;
        tpj(document).ready(function() {
    
            tpj('div#main_navigation_container ul#main_menu li#menu-item-home').addClass('active current-menu-parent');
            
            if (tpj('#rev_slider_1_1').revolution == undefined) {
                revslider_showDoubleJqueryError('#rev_slider_1_1');
            } else {
                revapi1 = tpj('#rev_slider_1_1').show().revolution({
                    dottedOverlay: "none",
                    delay: 9000,
                    startwidth: 1150,
                    startheight: 600,
                    hideThumbs: 200,
                    thumbWidth: 100,
                    thumbHeight: 50,
                    thumbAmount: 3,
                    simplifyAll: "off",
                    navigationType: "bullet",
                    navigationArrows: "solo",
                    navigationStyle: "round",
                    touchenabled: "on",
                    onHoverStop: "on",
                    nextSlideOnWindowFocus: "off",
                    swipe_threshold: 0.7,
                    swipe_min_touches: 1,
                    drag_block_vertical: false,
                    keyboardNavigation: "off",
                    navigationHAlign: "center",
                    navigationVAlign: "bottom",
                    navigationHOffset: 0,
                    navigationVOffset: 20,
                    soloArrowLeftHalign: "left",
                    soloArrowLeftValign: "center",
                    soloArrowLeftHOffset: 0,
                    soloArrowLeftVOffset: 0,
                    soloArrowRightHalign: "right",
                    soloArrowRightValign: "center",
                    soloArrowRightHOffset: 0,
                    soloArrowRightVOffset: 0,
                    shadow: 0,
                    fullWidth: "on",
                    fullScreen: "off",
                    spinner: "spinner0",
                    stopLoop: "off",
                    stopAfterLoops: -1,
                    stopAtSlide: -1,
                    shuffle: "off",
                    autoHeight: "off",
                    forceFullWidth: "off",
                    hideTimerBar: "on",
                    hideThumbsOnMobile: "off",
                    hideNavDelayOnMobile: 1500,
                    hideBulletsOnMobile: "off",
                    hideArrowsOnMobile: "off",
                    hideThumbsUnderResolution: 0,
                    hideSliderAtLimit: 0,
                    hideCaptionAtLimit: 0,
                    hideAllCaptionAtLilmit: 0,
                    startWithSlide: 0
                });
            }
            
            
            
        }); /*ready*/
        
        tpj(document).on("click", "div.overlay-content", function(){
            var target = tpj(this).attr("link-target");
            if(target) window.location.href = target;
        });
</script>
@endsection
