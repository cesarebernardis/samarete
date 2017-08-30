@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-primary">
               <div class="panel-heading">
                   <div class="row">
                      <div class="col-xs-3"><i class="fa fa-user fa-5x"></i></div>
                         <div class="col-xs-9 text-right">
                         <div class="huge">{{ $counters['users'] }}</div>
                         <div>Utenti</div>
                      </div>
                   </div>
               </div>
               <a href="/admin/users/">
                   <div class="panel-footer">
                       <span class="pull-left">Gestisci utenti</span>
                       <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                       <div class="clearfix"></div>
                   </div>
               </a>
           </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-yellow">
               <div class="panel-heading">
                   <div class="row">
                      <div class="col-xs-3"><i class="fa fa-list fa-5x"></i></div>
                         <div class="col-xs-9 text-right">
                         <div class="huge">{{ $counters['ruolo'] }}</div>
                         <div>Ruoli</div>
                      </div>
                   </div>
               </div>
               <a href="/admin/ruoli/">
                   <div class="panel-footer">
                       <span class="pull-left">Gestisci Ruoli</span>
                       <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                       <div class="clearfix"></div>
                   </div>
               </a>
           </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-red">
               <div class="panel-heading">
                   <div class="row">
                      <div class="col-xs-3"><i class="fa fa-check-square-o fa-5x"></i></div>
                         <div class="col-xs-9 text-right">
                         <div class="huge">{{ $counters['permesso'] }}</div>
                         <div>Permessi</div>
                      </div>
                   </div>
               </div>
               <a href="/admin/permessi/">
                   <div class="panel-footer">
                       <span class="pull-left">Gestisci Permessi</span>
                       <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                       <div class="clearfix"></div>
                   </div>
               </a>
           </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-green">
               <div class="panel-heading">
                   <div class="row">
                      <div class="col-xs-3"><i class="fa fa-users fa-5x"></i></div>
                         <div class="col-xs-9 text-right">
                         <div class="huge">{{ $counters['associazione'] }}</div>
                         <div>Associazioni</div>
                      </div>
                   </div>
               </div>
               <a href="/admin/associazioni/">
                   <div class="panel-footer">
                       <span class="pull-left">Gestisci Associazioni</span>
                       <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                       <div class="clearfix"></div>
                   </div>
               </a>
           </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">

</script>
@endsection
