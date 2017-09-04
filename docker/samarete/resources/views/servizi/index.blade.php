@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/servizi/index.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row itemlist">
    @if (empty($servizi))
        <h2>Nessun servizio trovato</h2>
    @else
        @foreach ($servizi as $servizio)
            <div class="col-md-4">
                <div class="well item">
                    <div class="thumbnail"><img src="{{ empty($servizio->logo_base64) ? '/public/img/no-image-available.png' : $servizio->logo_base64 }}"/></div>
                    <a href="/servizi/view-servizio?id={{ $servizio->id }}"><h4 class="title">{{ $servizio->nome }}</h4></a>
                    <p class="object">{{ $servizio->oggetto }}</p>
                </div>
            </div>
        @endforeach
     @endif
    </div>
    @can('create', Samarete\Models\Servizio::class)
    <div class="row">
        <div class="col-md-12">
            <a href="/servizi/edit-servizio"><button class="btn btn-primary">Crea nuovo servizio</button></a>
        </div>
    </div>
    @endcan
</div>
@endsection

@section('scripts')
<script type="text/javascript">

</script>
@endsection