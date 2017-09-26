@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/associazioni/index.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row itemlist">
    @if (empty($associazioni))
        <h2>Nessun associazione trovato</h2>
    @else
        @foreach ($associazioni as $associazione)
            <div class="col-md-4">
                <div class="well item">
                    <div class="thumbnail"><img src="{{ empty($associazione->logo_base64) ? asset('img/no-image-available.png') : $associazione->logo_base64 }}"/></div>
                    <a href="/associazioni/view-associazione?id={{ $associazione->id }}"><h4 class="title">{{ $associazione->nome }}</h4></a>
                </div>
            </div>
        @endforeach
    @endif
    </div>
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

</script>
@endsection