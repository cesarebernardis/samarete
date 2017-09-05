@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/progetti/index.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row itemlist">
    @if (empty($progetti))
        <h2>Nessun progetto trovato</h2>
    @else
        @foreach ($progetti as $progetto)
            <div class="col-md-4">
                <div class="well item">
                    <div class="thumbnail"><img src="{{ empty($progetto->logo_base64) ? asset('img/no-image-available.png') : $progetto->logo_base64 }}"/></div>
                    <a href="/progetti/view-progetto?id={{ $progetto->id }}"><h4 class="title">{{ $progetto->nome }}</h4></a>
                    <p class="object">{{ $progetto->oggetto }}</p>
                </div>
            </div>
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
@endsection

@section('scripts')
<script type="text/javascript">

</script>
@endsection