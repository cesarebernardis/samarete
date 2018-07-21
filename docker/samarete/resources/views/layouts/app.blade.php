<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
	<!--[if lte IE 8]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

    <!-- Styles -->
    <link href="{{ asset('components/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('components/bootstrap-datatables/datatables-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('components/bootstrap-datepicker/css/datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('components/bootstrap-datetimepicker/datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('components/metisMenu/metisMenu.min.css') }}" rel="stylesheet">
    <link href="{{ asset('components/sb-admin-2/css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('components/sweetalert/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('components/material-design/colors.min.css') }}" rel="stylesheet">
    <link href="{{ asset('components/select2/select2.min.css?v='.time()) }}" rel="stylesheet">
    <link href="{{ asset('components/dropzone/dropzone.css') }}" rel="stylesheet">
    <link href="{{ asset('components/fullcalendar/fullcalendar.min.css?v='.time()) }}" rel="stylesheet">

    <!-- Theme stylesheets -->
	<link rel='stylesheet' href='{{ asset("components/aperio-theme/revslider/rs-plugin/css/settings.css") }}' type='text/css' media='all'/>
	<link rel='stylesheet' href='{{ asset("components/aperio-theme/css/instag-slider.css") }}' type='text/css' media='all'/>
	<link rel='stylesheet' href='{{ asset("components/aperio-theme/css/style.css") }}' type='text/css' media='all'/>
	<link rel='stylesheet' href='{{ asset("components/aperio-theme/css/layout.css") }}' type='text/css' media='all'/>
	<link rel='stylesheet' href='{{ asset("components/aperio-theme/css/main.css?v=".time()) }}' type='text/css' media='all'/>
	<link rel='stylesheet' href='{{ asset("components/aperio-theme/css/shortcodes.css") }}' type='text/css' media='all'/>
	<link rel='stylesheet' href='{{ asset("components/aperio-theme/css/mediaelementplayer.min.css") }}' type='text/css' media='all'/>
	<link rel='stylesheet' href='{{ asset("components/aperio-theme/css/woocommerce.css") }}' type='text/css' media='all'/>
	<link rel='stylesheet' href='{{ asset("components/aperio-theme/css/prettyPhoto.css") }}' type='text/css' media='all'/>
	<link rel='stylesheet' href='{{ asset("components/aperio-theme/css/responsive.css") }}' type='text/css' media='all'/>
	<link rel='stylesheet' href='{{ asset("components/aperio-theme/css/js_composer.css") }}' type='text/css' media='all'/>
	<link rel='stylesheet' href='{{ asset("components/aperio-theme/css/default.css?v=".time()) }}' type='text/css' media='screen'/>
	<link rel='stylesheet' href='{{ asset("components/aperio-theme/css/fontawesome.css") }}' type='text/css' media='screen'/>
	<link rel='stylesheet' href='{{ asset("components/aperio-theme/css/font-awesome.css") }}' type='text/css' media='screen'/>

	<link href='https://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
    
    <link href="{{ asset('css/app.css?v='.time()) }}" rel="stylesheet">
    @yield('styles')
    
    <!-- Scripts -->
    <script src="{{ asset('components/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('components/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('components/momentjs/moment-with-locales.js') }}"></script>
    <script src="{{ asset('components/jquery-validation/jquery-validation.min.js') }}"></script>
    <script src="{{ asset('components/jquery-validation/jquery-validation.addon.min.js') }}"></script>
    <script src="{{ asset('components/jquery-pagination/jquery.paging.min.js') }}"></script>
    <script src="{{ asset('components/metisMenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('components/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('components/morrisjs/morris.min.js') }}"></script>
    <script src="{{ asset('components/sb-admin-2/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('components/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('components/bootstrap-datatables/datatables-bootstrap.js') }}"></script>
    <script src="{{ asset('components/bootstrap-datepicker/js/datepicker.min.js') }}"></script>
    <script src="{{ asset('components/bootstrap-datepicker/locales/datepicker.it.min.js') }}"></script>
    <script src="{{ asset('components/bootstrap-datetimepicker/datetimepicker.min.js') }}"></script>
    <script src="{{ asset('components/sweetalert/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('components/select2/select2.min.js') }}"></script>
    <script src="{{ asset('components/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('components/fullcalendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('components/fullcalendar/locale/it.js') }}"></script>
    <script src="{{ asset('components/tinymce/tinymce.min.js') }}"></script>
    
    <!-- Theme Scripts -->
    <script type='text/javascript' src='{{ asset("components/aperio-theme/js/jquery/jquery-migrate.min.js") }}'></script>
	<script type='text/javascript' src='{{ asset("components/aperio-theme/revslider/rs-plugin/js/jquery.themepunch.tools.min.js") }}'></script>
	<script type='text/javascript' src='{{ asset("components/aperio-theme/revslider/rs-plugin/js/jquery.themepunch.revolution.min.js") }}'></script>
	<script type='text/javascript' src='{{ asset("components/aperio-theme/js/jquery.flexslider-min.js") }}'></script>
	<script type='text/javascript' src='{{ asset("components/aperio-theme/js/frontend/add-to-cart.min.js") }}'></script>
	<script type='text/javascript' src='{{ asset("components/aperio-theme/js/jquery-blockui/jquery.blockUI.min.js") }}'></script>
	<script type='text/javascript' src='{{ asset("components/aperio-theme/js/frontend/woocommerce.min.js") }}'></script>
	<script type='text/javascript' src='{{ asset("components/aperio-theme/js/jquery-cookie/jquery.cookie.min.js") }}'></script>
	<script type='text/javascript' src='{{ asset("components/aperio-theme/js/frontend/cart-fragments.min.js") }}'></script>
	<script type='text/javascript' src='{{ asset("components/aperio-theme/js/brad-love.js") }}'></script>
	<script type='text/javascript' src='{{ asset("components/aperio-theme/js/modernizr.js") }}'></script>
	<script type='text/javascript' src='{{ asset("components/aperio-theme/js/fitvids.min.js") }}'></script>
	<script type='text/javascript' src='{{ asset("components/aperio-theme/js/prettyPhoto.js") }}'></script>
	<script type='text/javascript' src='{{ asset("components/aperio-theme/js/plugins.js") }}'></script>
	<script type='text/javascript' src='{{ asset("components/aperio-theme/js/skrollr.js") }}'></script>
	<script type='text/javascript' src='{{ asset("components/aperio-theme/js/imagesloaded.js") }}'></script>
	<script type='text/javascript' src='{{ asset("components/aperio-theme/js/jquery.scrollTo.min.js") }}'></script>
	<script type='text/javascript' src='{{ asset("components/aperio-theme/js/waypoints.min.js") }}'></script>
	<script type='text/javascript' src='{{ asset("components/aperio-theme/js/isotope.pkgd.min.js") }}'></script>
	<script type='text/javascript' src='{{ asset("components/aperio-theme/js/bxslider.min.js") }}'></script>
	<script type='text/javascript' src='{{ asset("components/aperio-theme/js/caroufred.js") }}'></script>
	<script type='text/javascript' src='{{ asset("components/aperio-theme/js/main.min.js") }}'></script>
	<script type='text/javascript' src='{{ asset("components/aperio-theme/js/contact-form.js") }}'></script>
    
</head>
<body class="home page page-id-12 page-template page-template-fullwidth-php solid-header header-scheme-light type1 header-fullwidth-no border-default wpb-js-composer js-comp-ver-4.3.5 vc_responsive">
    <div id="mobile_navigation">
        <a id="close-mobile-menu" href="#">X</a>
        <ul id="mobile_menu" class="mobile_menu">
            <li class="menu-item current-menu-item" id="menu-item-home"><a href="/">Home</a></li>
            <li class="menu-item" id="menu-item-associazioni"><a href="/associazioni">Associazioni</a></li>
            <li class="menu-item" id="menu-item-eventi"><a href="/eventi">Eventi</a></li>
            <li class="menu-item" id="menu-item-servizi"><a href="/servizi">Servizi</a></li>
            <li class="menu-item" id="menu-item-progetti"><a href="/progetti">Progetti</a></li>
            <li class="menu-item" id="menu-item-richieste-new"><a href="/richieste/new">Chiedi Aiuto</a></li>
            <li class="menu-item" id="menu-item-calendario"><a href="/calendario">Calendario</a></li>
            @if (Auth::guest())
                <li class="menu-item" id="menu-item-login"><a href="{{ route('login') }}">Login</a></li>
            @else
                <li class="menu-item menu-item-has-children" id="menu-item-profilo"><a href="#">Il mio profilo</a>
                <ul class="sub-menu">
                @if (!empty(Auth::user()->associazione_id))
                    <li class="menu-item" id="menu-item-richieste"><a href="/richieste">Richieste</a></li>
                    <li class="menu-item" id="menu-item-chat"><a href="/chat">Chat</a></li>
                @endif
                @if (Auth::user()->isAdmin())
                    <li class="menu-item" id="menu-item-admin"><a href="/admin">Amministrazione</a></li>
                @endif
                    <li><a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                           {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
            @endif
        </ul>
    </div>
    
    <!-- Boxed Layout -->
    <!-- <div class="boxed-layout boxed-shadow-no tcover-padding-no hcover-padding-yes  padding-yes vpadding-no style-default"> -->
    <div class="tcover-padding-no hcover-padding-yes  padding-yes vpadding-no style-default">
        <!-- Header -->
        <div id="header_wrapper" class=" solid-header header-scheme-light type3">
            <div class="header_container">
                <div id="header" class=" solid-header header-scheme-light type3 second-nav" data-height="150" data-shrinked-height="65" data-auto-offset="1" data-offset="0" data-second-nav-offset="0">
                    <section id="main_navigation" class="header-nav">
                    <div class="container">
                        <div id="top_navigation_container" class="row-fluid">
                            <div class="row-fluid">
                                <!-- Social Icons -->
                                <ul class="social-icons clearfix">
                                    <li><a class="rss" href="#" target="_blank" title="RSS"><i class="fa-rss"></i></a></li>
                                </ul>
                                <!-- logo -->
                                <div class="logo-container">
                                    <a id="logo" href="/">
                                    <img src="{{ asset('components/aperio-theme/images/logo.png') }}" class="default-logo" alt="Samarete">
                                    </a>
                                </div>
                                <!-- Tooggle Menu will displace on mobile devices -->
                                <div id="mobile-menu-container">
                                    <a href="#" class="carticon-mobile"><i class="fa-shopping-cart"></i></a>
                                    <a class="toggle-menu" href="#"><i class="fa-navicon"></i></a>
                                </div>
                                <div class="header-right-content">
                                    <!-- Header Search Button -->
                                    <div id="header-search-button">
                                        <a href="#" class="search-button"><i class="fa-search"></i></a>
                                        <div id="header-search-panel">
                                            <div class="search">
                                                <form action="#" id="header-search-form" method="get">
                                                    <input type="text" id="header-search" name="s" value="" placeholder="Premi invio per cercare" autocomplete="off"/>
                                                    <!-- Create a fake search button -->
                                                    <input type="submit" name="submit" value="submit"/>
                                                </form>
                                                <span class="close-icon"><i class="fa fa-search"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </section>
                    <section class="nav-container border-default dw-grid ">
                    <div class="header-divider full-divider divider-grid">
                    </div>
                    <div class="header-divider full-divider header-divider-bottom">
                    </div>
                    <div class="container">
                        <div id="main_navigation_container" class="row-fluid">
                            <div class="header-divider grid-divider">
                            </div>
                            <div class="header-divider header-divider-bottom grid-divider">
                            </div>
                            
                             <ul id="main_menu" class="main_menu style1">
                                <!-- Main Navigation Menu -->
                                <li class="menu-item" id="menu-item-home"><a href="/">Home</a></li>
                                <li class="menu-item" id="menu-item-associazioni"><a href="/associazioni">Associazioni</a></li>
                                <li class="menu-item" id="menu-item-eventi"><a href="/eventi">Eventi</a></li>
                                <li class="menu-item" id="menu-item-servizi"><a href="/servizi">Servizi</a></li>
                                <li class="menu-item" id="menu-item-progetti"><a href="/progetti">Progetti</a></li>
                                <li class="menu-item" id="menu-item-richieste-new"><a href="/richieste/new">Chiedi Aiuto</a></li>
                                <li class="menu-item" id="menu-item-calendario"><a href="/calendario">Calendario</a></li>
                                @if (Auth::guest())
                                    <li class="menu-item" id="menu-item-login"><a href="{{ route('login') }}">Login</a></li>
                                @else
                                    <li class="menu-item menu-item-has-children" id="menu-item-profilo"><a href="#">Il mio profilo</a>
                                            <ul class="sub-menu">
                                            @if (!empty(Auth::user()->associazione_id))
                                                <li class="menu-item" id="menu-item-richieste"><a href="/richieste">Richieste</a></li>
                                                <li class="menu-item" id="menu-item-chat"><a href="/chat">Chat</a></li>
                                            @endif
                                            @if (Auth::user()->isAdmin())
                                                <li class="menu-item" id="menu-item-admin"><a href="/admin">Amministrazione</a></li>
                                            @endif
                                                <li>
                                                    <a href="{{ route('logout') }}"
                                                        onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">Logout</a>

                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        {{ csrf_field() }}
                                                    </form>
                                                </li>
                                            </ul>
                                        </li>
                                @endif
                            </ul>
                            <!-- en nav -->
                        </div>
                    </div>
                    </section>
                </div>
            </div>
        </div>
        <!--End Header -->
        <div class="fullwidth">
        @yield('content')
        </div>
        
        <footer id="footer" class="cover-padding-no">
        <div class="footer-widgets headline-bg-transparent">
            <div class="container">
                <div class="row-fluid">
                    <div class="footer-widget-container row-fluid">
                        <div id="text-2" class="widget widget_meta widget_text span3">
                            <h4>Contattaci</h4>
                            <div class="textwidget">
                                Via Temporanea 1, Samarate
                                <br> E: no-reply@samarete.com
                                <br> T: 1234567890
                                <div class="gap" style="height:10px"></div>
                                <ul id="brad_icons_1" class="brad-icons medium style1 icons-align-">
                                    <li><a href="#" title="Twitter" target="_self"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#" title="Facebook" target="_self"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#" title="Google" target="_self"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#" title="Flickr" target="_self"><i class="fa fa-flickr"></i></a></li>
                                    <li><a href="#" title="Instagram" target="_self"><i class="fa fa-instagram"></i></a></li>
                                    <li><a href="#" title="Youtube" target="_self"><i class="fa fa-youtube"></i></a></li>
                                    <li><a href="#" title="Skype" target="_self"><i class="fa fa-skype"></i></a></li>
                                    <li><a href="#" title="Vimeo" target="_self"><i class="fa fa-vimeo-square"></i></a></li>
                                    <li><a href="#" title="LinkedIn" target="_self"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#" title="" target="_self"><i class="fa fa-behance"></i></a></li>
                                    <li><a href="#" title="Tumblr" target="_self"><i class="fa fa-tumblr"></i></a></li>
                                    <li><a href="#" title="Dropbox" target="_self"><i class="fa fa-dropbox"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- <div id="recent-posts-3" class="widget widget_meta widget_recent_entries span3">
                            <h4>Recent Posts</h4>
                            <ul>
                                <li>
                                    <a href="#">Standard post with preview picture</a>
                                    <span class="post-date">November 11, 2013</span>
                                </li>
                                <li>
                                    <a href="#">Another Post with Preview picture</a>
                                    <span class="post-date">November 8, 2013</span>
                                </li>
                                <li>
                                    <a href="#">Quis lectus elemvolu euismod atras</a>
                                    <span class="post-date">November 7, 2013</span>
                                </li>
                            </ul>
                        </div>
                        <div id="twitter-2" class="widget widget_meta widget_twitter span3">
                            <h4>Latest Tweets</h4>
                            <div class="recent-tweets" id="recent_tweets_1515707491">
                                <ul>
                                    <li><span>Our Latest Creative Wordpress Theme "Retigo" has been realsed on themeforest today. Check it Out on Themeforest <a href="http://t.co/hVtABj5tZo" target="_blank">http://t.co/hVtABj5tZo</a></span>
                                        <br><a class="timestamp" href="https://twitter.com/brad_web/status/474411858321887232" target="_blank">1 year ago</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="portfolio-widget-3" class="widget widget_meta portfolios span3">
                            <h4>Recent Works</h4>
                            <div class="recent-works-items clearfix">
                                <a href="#" title="Business Photogrpagy" class="hoverborder">
                                    <img width="80" height="80" src="upload/portfolio16-80x80.jpg" class="attachment-mini wp-post-image" alt="portfolio16"></a>
                                <a href="#" title="Brand Development" class="hoverborder">
                                    <img width="80" height="80" src="upload/portfolio5-80x80.jpg" class="attachment-mini wp-post-image" alt="portfolio5"></a>
                                <a href="#" title="Product Design" class="hoverborder">
                                    <img width="80" height="80" src="upload/portfolio11-80x80.jpg" class="attachment-mini wp-post-image" alt="portfolio11"></a>
                                <a href="#" title="Work Gallery Slider" class="hoverborder">
                                    <img width="80" height="80" src="upload/shutterstock_191213546-80x80.jpg" class="attachment-mini wp-post-image" alt="shutterstock_191213546"></a>
                                <a href="#" title="Beautiful Shelfs" class="hoverborder">
                                    <img width="80" height="80" src="upload/shutterstock_202793287-80x80.jpg" class="attachment-mini wp-post-image" alt="shutterstock_202793287"></a>
                                <a href="#" title="High Mountains" class="hoverborder">
                                    <img width="80" height="80" src="upload/shutterstock_206876992-80x80.jpg" class="attachment-mini wp-post-image" alt="shutterstock_206876992"></a>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <div id="copyright">
            <div class="container">
                <div class="row-fluid">
                    <div class="row-fluid">
                        <div class="copyright-text copyright-left">
                            Aperio v1.0 <!-- by <a href="http://themeforest.net/user/max-themes">max-themes</a> -->
                        </div>
                        <div class="textright copyright-right">
                            <a id="go-top" class="go-top readmore" href="#"><span>Torna su</span><span class="brad-icon"><i class="fa fa-caret-up"></i></span></a>
                            <!-- Top Bar Social Icons END -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
        
    </div>

    <script src="{{ asset('js/app.js?v='.time()) }}"></script>
    <script src="{{ asset('js/ajaxsetup.js?v='.time()) }}"></script>
    
    @yield('scripts')
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgGHLtJffda0vAcg6lLSUCBpS3r5k7GX4&callback=initializeMaps&libraries=places" async defer></script>
    
    <script type="text/javascript">
    
        (function($){
            'use strict';
            jQuery(document).ready(function($){ 
              var retina = window.devicePixelRatio > 1 ? true : false;
              if(retina) {
                    jQuery('#logo .default-logo').attr('src', "{{ asset('components/aperio-theme/images/logo_2x.png') }}" );
                    
                /* ------------------------------------------------------------------------ */
                /* Add PrettyPhoto */
                /* ------------------------------------------------------------------------ */
                var lightboxArgs = {            
                                animation_speed: 'fast',
                                overlay_gallery: true,
                    autoplay_slideshow: false,
                                slideshow: 5000, /* light_rounded / dark_rounded / light_square / dark_square / facebook */
                                            theme: 'pp_default', 
                                            opacity: 0.8,
                                show_title: true,
                                deeplinking: false,
                    allow_resize: true,             /* Resize the photos bigger than viewport. true/false */
                    counter_separator_label: '/',   /* The separator for the gallery counter 1 "of" 2 */
                    default_width: 1200,
                    default_height:640
                };
                jQuery("a[data-gal^='prettyPhoto']").prettyPhoto(lightboxArgs);
              }
              
              $('div#main_navigation_container ul#main_menu li.menu-item').click(function(){
                  var child = $(this).children('a');
                  if(child)
                    window.location.href = $(child).attr('href');
              });
              
              $('a#go-top').click(function(){
                  $('html, body').animate({ scrollTop: 0 }, 'fast');
              });
              
            });
        }(jQuery))
        
        tinymce.init({ 
            selector: 'textarea.tinymce' ,
            menubar: 'edit view format table tools',
            plugins: [
                'advlist lists textcolor searchreplace visualblocks fullscreen table contextmenu paste code help'
              ],
            toolbar1: 'undo redo | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table ',
        });
    </script>
    
</body>
</html>
