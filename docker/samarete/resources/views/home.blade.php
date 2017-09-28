@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row itemlist">
                <div class="col-md-6">
                    <div class="well item text-align-center">
                        <div class="thumbnail"><img src="{{ asset('img/associazioni.jpeg') }}"/></div>
                            <a href="/associazioni"><h3 class="title">Associazioni</h3></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="well item text-align-center">
                        <div class="thumbnail"><img src="{{ asset('img/aiuto.jpg') }}"/></div>
                            <a href="/richieste/new"><h3 class="title">Chiedi aiuto</h3></a>
                    </div>
                </div>
            </div>
            <div class="row itemlist">
                <div class="col-md-4">
                    <div class="well item text-align-center">
                        <div class="thumbnail"><img src="{{ asset('img/evento.jpg') }}"/></div>
                            <a href="/eventi"><h3 class="title">Eventi</h3></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="well item text-align-center">
                        <div class="thumbnail"><img src="{{ asset('img/servizio.jpg') }}"/></div>
                            <a href="/servizi"><h3 class="title">Servizi</h3></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="well item text-align-center">
                        <div class="thumbnail"><img src="{{ asset('img/progetto.jpg') }}"/></div>
                            <a href="/progetti"><h3 class="title">Progetti</h3></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
        </div>
    </div>
</div>
@endsection
