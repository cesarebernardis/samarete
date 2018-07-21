@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/associazioni/index.css?v='.time()) }}" rel="stylesheet">
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
                                    <h1><span>ASSOCIAZIONI</span></h1>
                                    <div class="hr hr-border-primary double-border border-small">
                                        <span></span>
                                    </div>
                                    <div class="titlebar-subcontent">
                                        Se stai cercando qualcuno che possa darti una mano<br/>
                                        sei proprio nel posto giusto
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
            <div class="row-fluid">
                 <div class="row-fluid equal-cheight-no element-padding-default element-vpadding-default">
                     <div class="section-column span12" style="">
                         <div class="inner-content content-box textnone" style="padding:0px;">
            @if (empty($associazioni))
                <h2>Nessuna associazione trovata</h2>
            @else
                <div id="portfolio_960272301" class="portfolio padding-medium">
                     <div id="associazioni-container" class="row-fluid portfolio-items bg-style-white-smoke portfolio-style2 columns-3 love-it-no enable-hr-yes hr-type-small hr-color-primary hr-style-double element-padding-medium info-style-left element-vpadding-default info-onhover-yes " data-columns="3" data-animation-delay="0" data-animation-effect="" data-masonry-layout="no">
                                                    
                @foreach ($associazioni as $associazione)
                        <div class="portfolio-item span scheme-default">
                           <div class="inner-content">
                               <div class="image hoverlay">
                                   <a href="#" target="_self"><img src="{{ empty($associazione->logo_base64) ? asset('img/no-image-available.png') : $associazione->logo_base64 }}" class="attachment-thumb-large" alt="{{ $associazione->nome }}"/></a>
                                   <div class="overlay">
                                       <div class="overlay-content">
                                           <div class="overlay-icons">
                                                <a href="/associazioni/view-associazione?id={{ $associazione->id }}" target="_self" class="lightbox-icon">
                                                <i class="fa fa-icon_link"></i>
                                                </a>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="info">
                                  <h3><a href="/associazioni/view-associazione?id={{ $associazione->id }}" target="_self" title="{{ $associazione->nome }}">{{ $associazione->nome }}</a></h3>
                                  <div class="hr"><span></span></div>
                                  @if(!empty($associazione->acronimo))
                                       <h5>{{ $associazione->acronimo }}</h5>
                                  @endif
                                  @if(!empty($associazione->email))
                                      <h5>{{ $associazione->email }}</h5>
                                  @endif
                                  @if(!empty($associazione->telefono_1))
                                      <h5>{{ $associazione->telefono_1 }}</h5>
                                  @endif
                                  @if(!empty($associazione->indirizzo))
                                      <h5>{{ $associazione->indirizzo }}</h5>
                                  @endif
                                  @if(!empty($associazione->sito_web))
                                      <h5>{{ $associazione->sito_web }}</h5>
                                  @endif
                               </div>
                           </div>
                        </div>
                @endforeach
                </div>
            </div>
            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            @can('create', Samarete\Models\Associazione::class)
            <div class="row">
                <div class="col-md-12">
                    <a href="/associazioni/edit-associazione"><button class="button button_default button_color_default button_default border-radius-default icon-align-left">Crea nuova associazione</button></a>
                </div>
            </div>
            @endcan
            
            <div class="page-nav clearfix" id="pagination"></div>
        </div>
    </section>
@endsection

@section('scripts')
<script type="text/javascript">

$(document).ready(function(){
    
    $('div#main_navigation_container ul#main_menu li#menu-item-associazioni').addClass('active current-menu-parent');
    
    var originalQuery = "{{ $query }}";
    
    function relocate(){
        var query = $("input#query-cerca").val();
        if(!query && !originalQuery) return;
        window.location.replace("/associazioni/?search="+query);
    }
    
    $("button#submit-cerca").click(relocate);
    
    $('input#query-cerca').keypress(function(event) {
        if (event.keyCode == 13 || event.which == 13) {
            relocate();
        }
    });
    
    function add_associazione(data){
        var img = "img/no-image-available.png";
        if(data.logo_base64){
            img = data.logo_base64;
        }
        var html = '<div class="portfolio-item span scheme-default"> \
                           <div class="inner-content"> \
                               <div class="image hoverlay"> \
                                   <a href="#" target="_self"><img src="'+img+'" class="attachment-thumb-large" alt="'+data.nome+'"/></a> \
                                   <div class="overlay"> \
                                       <div class="overlay-content"> \
                                           <div class="overlay-icons"> \
                                                <a href="/associazioni/view-associazione?id='+data.id+'" target="_self" class="lightbox-icon"> \
                                                <i class="fa fa-icon_link"></i> \
                                                </a> \
                                           </div> \
                                       </div> \
                                   </div> \
                               </div> \
                               <div class="info"> \
                                  <h3><a href="/associazioni/view-associazione?id='+data.id+'" target="_self" title="'+data.nome+'">'+data.nome+'</a></h3> \
                                  <div class="hr"><span></span></div> ';
        if(data.acronimo){
           html += '<h5>'+data.acronimo+'</h5>';
        }
        if(data.email){
           html += '<h5>'+data.email+'</h5>';
        }
        if(data.telefono_1){
           html += '<h5>'+data.telefono_1+'</h5>';
        }
        if(data.indirizzo){
           html += '<h5>'+data.indirizzo+'</h5>';
        }
        if(data.sito_web){
           html += '<h5>'+data.sito_web+'</h5>';
        }
        html += "</div></div></div>";
        $('div#associazioni-container').append(html);
    }
    
    $("div#pagination").paging({{ count($associazioni) }}, { 
        format: '< ncn! >', // define how the navigation should look like and in which order onFormat() get's called
        perpage: 9, // show 9 elements per page
        lapping: 0, // don't overlap pages for the moment
        page: 1, // start at page, can also be "null" or negative
        onSelect: function (page) {
            // add code which gets executed when user selects a page, how about $.ajax() or $(...).slice()?
            $.ajax({
                type: 'GET',
                url: '/associazioni/get-associazioni',
                data: {page: page, search: "{{ $query }}"},
                success: function(data){
                    $('div#associazioni-container').empty();
                    data.forEach(add_associazione);
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