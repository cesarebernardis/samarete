@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/eventi/index.css?v='.time()) }}" rel="stylesheet">
@endsection

@section('content')
    <section id="titlebar" class="titlebar titlebar-type-solid border-yes titlebar-scheme-light titlebar-alignment-center titlebar-valignment-center titlebar-size-large enable-hr-yes" data-height="350" data-rs-height="yes">
            <div class="parallax-image parallax-section-no" style="background-image: url('{{ asset('img/eventi/header.jpg') }}');"></div>
            <div class="section-overlay"></div>
            <div class="titlebar-wrapper" style="height: 350px; min-height: 350px;">
                <div class="titlebar-content">
                    <div class="container">
                        <div class="row-fluid">
                            <div class="row-fluid">
                                <div class="titlebar-heading">
                                    <h1><span>EVENTI</span></h1>
                                    <div class="hr hr-border-primary double-border border-small">
                                        <span></span>
                                    </div>
                                    <div class="titlebar-subcontent">
                                        Proposte, iniziative e attivit&agrave; in programma<br/>
                                        per tutta la comunit&agrave;
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    
    <div class="section-with-sidebar">
        <div class="container">
            <div class="row-fluid">
                <div class="row-fluid">
                    <div id="sidebar" class="span3 sidebar sidebar-right" style="">
                        <div class="inner-content">
                            <div id="search-2" class="widget widget_meta widget_search">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Cerca..." id="query-cerca" size="50" maxlength="50" value="{{ empty($query) ? '' : $query }}"/>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button" id="submit-cerca">
                                        <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div id="recent-posts-2" class="widget widget_meta widget_recent_entries">
                                <h4>Prossimi eventi</h4>
                                @if (empty($prossimi_eventi))
                                    <h6 class="text-align-center">Non ci sono eventi in programma</h6>
                                @else
                                    <ul>
                                    @foreach($prossimi_eventi as $evento)
                                        <li>
                                        <a href="/eventi/view-evento?id={{ $evento->id }}">{{ $evento->nome }}</a>
                                        <span class="post-date">{{ empty($evento->giorni) ? '' : $evento->giorni[0]->giorno }}</span>
                                        </li>
                                    @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div id="categories" class="widget widget_meta widget_categories">
                                <h4>Tag</h4>
                                <ul>
                                    <!-- <li class="cat-item cat-item-2"><a href="#">Animation</a></li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="content" class="content span9 content-left headline-bg-#f6f6f6">
                        <div class="inner-content">
                            <section class="section content-box section-border-no section-bborder-no section-height-content section-bgtype- section-fixed-background-no section-bgstyle-stretch section-triangle-no triangle-location-top parallax-section-no section-overlay-no section-overlay-dot-no " style="padding-top:0;padding-bottom:0;background-color:#ffffff;" data-video-ratio="" data-parallax-speed="1">
                            <div class="section-overlay" style=""></div>
                            <div class="container section-content">
                                <div class="row-fluid">
                                    <div class="row-fluid equal-cheight-no element-padding-default element-vpadding-default">
                                        <div class="section-column span12" style="">
                                            <div class="inner-content content-box textnone" style="padding:0px;">
                                                <div class="blog-gird ">
                                                    @if (empty($eventi))
                                                        <h2>Nessun evento trovato</h2>
                                                    @else
                                                        <ul id="associazioni-container" class="posts-grid row-fluid element-padding-medium element-vpadding-default posts-grid-bg-stroke">
                                                        @foreach ($eventi as $evento)
                                                            <li id="post-{{ $evento->id }}" class=" post type-post status-publish format-standard has-post-thumbnail hentry category-creative tag-animation tag-architecture tag-creative tag-designing tag-illustration-2 tag-video post-grid-item span6">
                                                            <div class="inner-content">
                                                                <a href="/eventi/view-evento?id={{ $evento->id }}">
                                                                <div class="image">
                                                                    <img src="{{ empty($evento->logo_base64) ? asset('img/no-image-available.png') : $evento->logo_base64 }}" class="attachment-thumb-large wp-post-image" alt="{{ $evento->nome }}"/>
                                                                </div>
                                                                </a>
                                                                <div class="post-text-container">
                                                                    <div class="post-meta-data style2">
                                                                        <!-- <span class="post-meta-cats"><a href="#" rel="category tag">Creative</a></span> -->
                                                                        <span class="post-meta-date">{{ empty($evento->giorni) ? '' : $evento->giorni[0]->giorno }}</span>
                                                                    </div>
                                                                    <h4><a href="#" title="{{ $evento->nome }}"> {{ $evento->nome }} </a></h4>
                                                                    <p class="excerpt">
                                                                         {{ substr($evento->oggetto, 0, 100) . (strlen($evento->oggetto) > 100 ? "..." : "") }}
                                                                    </p>
                                                                    <div class="post-bottom">
                                                                        <div class="post-meta-data"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </li>
                                                        @endforeach
                                                        </ul>
                                                    @endif
                                                    <p class="hidden">
                                                        <a href="#">Next Page &raquo;</a>
                                                    </p>
                                                    <div class="page-nav clearfix" id="pagination"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @can('create', Samarete\Models\Evento::class)
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="/eventi/edit-evento"><button class="button button_default button_color_default button_default border-radius-default icon-align-left">Crea nuovo evento</button></a>
                                </div>
                            </div>
                            @endcan
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script type="text/javascript">

$(document).ready(function(){
    
    $('div#main_navigation_container ul#main_menu li#menu-item-eventi').addClass('active current-menu-parent');
    
    var originalQuery = "{{ $query }}";
    
    function relocate(){
        var query = $("input#query-cerca").val();
        if(!query && !originalQuery) return;
        window.location.replace("/eventi/?search="+query);
    }
    
    $("button#submit-cerca").click(relocate);
    
    $('input#query-cerca').keypress(function(event) {
        if (event.keyCode == 13 || event.which == 13) {
            relocate();
        }
    });
    
    function add_evento(data){
        var img = "img/no-image-available.png";
        if(data.logo_base64){
            img = data.logo_base64;
        }
        
        var html = '<li id="post-'+data.id+'" class=" post type-post status-publish format-standard has-post-thumbnail hentry category-creative tag-animation tag-architecture tag-creative tag-designing tag-illustration-2 tag-video post-grid-item span6">\
                       <div class="inner-content">\
                         <a href="/eventi/view-evento?id='+data.id+'">\
                            <div class="image">\
                            <img src="'+img+'" class="attachment-thumb-large wp-post-image" alt="'+data.nome+'"/>\
                            </div>\
                         </a>\
                         <div class="post-text-container">\
                            <div class="post-meta-data style2">\
                                <span class="post-meta-date">{{ empty($evento->giorni) ? '' : $evento->giorni[0]->giorno }}</span>\
                            </div>\
                            <h4><a href="#" title="'+data.nome+'"> '+data.nome+' </a></h4>\
                            <p class="excerpt"> ' + data.oggetto.substr(0, 100) + (evento.length > 100 ? "..." : "") + ' </p>\
                            <div class="post-bottom">\
                                <div class="post-meta-data"></div>\
                             </div>\
                          </div>\
                       </div>\
                    </li>'
        
        html += "</div></div></div>";
        $('div#eventi-container').append(html);
    }
    
    $("div#pagination").paging({{ count($eventi) }}, { 
        format: '< ncn! >', // define how the navigation should look like and in which order onFormat() get's called
        perpage: 9, // show 9 elements per page
        lapping: 0, // don't overlap pages for the moment
        page: 1, // start at page, can also be "null" or negative
        onSelect: function (page) {
            // add code which gets executed when user selects a page, how about $.ajax() or $(...).slice()?
            $.ajax({
                type: 'GET',
                url: '/eventi/get-eventi',
                data: {page: page, search: "{{ $query }}"},
                success: function(data){
                    $('div#eventi-container').empty();
                    data.forEach(add_evento);
                },
            });
        },
        onFormat: function (type) {
            console.log(this);
            switch (type) {
                case 'block': // n and c
                    if(this.active){
                        if(this.value == this.page)
                            return '<span class="active">' + this.value + '</span>';
                        else
                            return '<a href="#'+this.value+'">' + this.value + '</a>';
                    }else return '';
                case 'next': // >
                    return '<a href="#" class="next"><i class="fa-angle-right"></i></a>';
                case 'prev': // <
                    return '<a href="#" class="prev"><i class="fa-angle-left"></i></a>';
                case 'first': // [
                    return '<a href="#">Primo</a>';
                case 'last': // ]
                    return '<a href="#">Ultimo</a>';
            }
        }
    });
    
});

</script>
@endsection