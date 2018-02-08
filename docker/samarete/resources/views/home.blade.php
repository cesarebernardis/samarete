@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row itemlist">
                <div class="col-md-6">
                    <a href="/associazioni"><div class="well item text-align-center">
                        <div class="thumbnail"><img src="{{ asset('img/associazioni.jpeg') }}"/></div>
                        <h3 class="title">Associazioni</h3>
                    </div></a>
                </div>
                <div class="col-md-6">
                    <a href="/richieste/new"><div class="well item text-align-center">
                        <div class="thumbnail"><img src="{{ asset('img/aiuto.jpg') }}"/></div>
                        <h3 class="title">Chiedi aiuto</h3>
                    </div></a>
                </div>
            </div>
            <div class="row itemlist">
                <div class="col-md-4">
                    <a href="/eventi"><div class="well item text-align-center">
                        <div class="thumbnail"><img src="{{ asset('img/evento.jpg') }}"/></div>
                        <h3 class="title">Eventi</h3>
                    </div></a>
                </div>
                <div class="col-md-4">
                    <a href="/servizi"><div class="well item text-align-center">
                        <div class="thumbnail"><img src="{{ asset('img/servizio.jpg') }}"/></div>
                        <h3 class="title">Servizi</h3>
                    </div></a>
                </div>
                <div class="col-md-4">
                    <a href="/progetti"><div class="well item text-align-center">
                        <div class="thumbnail"><img src="{{ asset('img/progetto.jpg') }}"/></div>
                        <h3 class="title">Progetti</h3>
                    </div></a>
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
