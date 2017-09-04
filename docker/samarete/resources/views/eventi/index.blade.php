@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/eventi/index.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row itemlist">
    @if (empty($eventi))
        <h2>Nessun evento trovato</h2>
    @else
        @foreach ($eventi as $evento)
            <div class="col-md-4">
                <div class="well item">
                    <div class="thumbnail"><img src="{{ empty($evento->logo_base64) ? '/public/img/no-image-available.png' : $evento->logo_base64 }}"/></div>
                    <a href="/eventi/view-evento?id={{ $evento->id }}"><h4 class="title">{{ $evento->nome }}</h4></a>
                    <p class="object">{{ $evento->oggetto }}</p>
                </div>
            </div>
        @endforeach
     @endif
    </div>
    @can('create', Samarete\Models\Evento::class)
    <div class="row">
        <div class="col-md-12">
            <a href="/eventi/edit-evento"><button class="btn btn-primary">Crea nuovo evento</button></a>
        </div>
    </div>
    @endcan
</div>
@endsection

@section('scripts')
<script type="text/javascript">

</script>
@endsection