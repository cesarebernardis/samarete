@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/associazioni/index.css?v='.time()) }}" rel="stylesheet">
@endsection

@section('content')
<div class="container section-content">
    
    <section id="section_511995896" class="section content-box section-border-no section-bborder-no section-height-content section-bgtype- section-fixed-background-no section-bgstyle-stretch section-triangle-no triangle-location-top parallax-section-no section-overlay-no section-overlay-dot-no ">
           
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
                    <!-- <div class="portfolio-tabs scheme1 portfolio-tabs-align-left portfolio-tabs-black clearfix">
                        <div class="portfolio-tabs-container">
                                            <ul class="clearfix">
                                                <li class="sort-label">Sort Portfolios :</li>
                                                <li class="sort-item active"><a data-filter="*" href="#">All</a></li>
                                                <li class="sort-item"><a data-filter=".branding" href="#">Branding</a></li>
                                                <li class="sort-item"><a data-filter=".creative" href="#">Creative</a></li>
                                                <li class="sort-item"><a data-filter=".design" href="#">Design</a></li>
                                                <li class="sort-item"><a data-filter=".identity" href="#">Identity</a></li>
                                                <li class="sort-item"><a data-filter=".photogrpahy" href="#">Photogrpahy</a></li>
                                                <li class="sort-item"><a data-filter=".print" href="#">Print</a></li>
                                            </ul>
                         </div>
                    </div> -->
                    
    @if (empty($associazioni))
        <h2>Nessuna associazione trovata</h2>
    @else
        <div id="portfolio_960272301" class="portfolio padding-medium">
             <div class="row-fluid portfolio-items bg-style-white-smoke portfolio-style2 columns-3 love-it-no enable-hr-yes hr-type-small hr-color-primary hr-style-double element-padding-medium info-style-left element-vpadding-default info-onhover-yes " data-columns="3" data-animation-delay="0" data-animation-effect="" data-masonry-layout="no">
                                            
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
    
    </section>
    @can('create', Samarete\Models\Associazione::class)
    <div class="row">
        <div class="col-md-12">
            <a href="/associazioni/edit-associazione"><button class="btn btn-primary">Crea nuova associazione</button></a>
        </div>
    </div>
    @endcan
</div>
@endsection

@section('scripts')
<script type="text/javascript">

$(document).ready(function(){
    
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
    
});

</script>
@endsection