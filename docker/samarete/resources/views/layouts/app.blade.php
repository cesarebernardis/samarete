<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('components/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('components/bootstrap-datatables/datatables-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('components/bootstrap-datepicker/css/datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('components/bootstrap-datetimepicker/datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('components/metisMenu/metisMenu.min.css') }}" rel="stylesheet">
    <link href="{{ asset('components/sb-admin-2/css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('components/sweetalert/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('components/material-design/colors.min.css') }}" rel="stylesheet">
    <link href="{{ asset('components/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('components/dropzone/dropzone.css') }}" rel="stylesheet">
    <link href="{{ asset('components/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="/associazioni">Associazioni</a></li>
                        <li><a href="/eventi">Eventi</a></li>
                        <li><a href="/servizi">Servizi</a></li>
                        <li><a href="/progetti">Progetti</a></li>
                        <li><a href="/richieste/new">Chiedi Aiuto</a></li>
                        <li><a href="/calendario">Calendario</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                        @else
                            <li><a href="/richieste">Richieste</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    @if (Auth::user()->isAdmin())
                                    <li>
                                        <a href="/admin"><i class="fa fa-cogs"></i>&nbsp;Amministrazione</a>
                                    </li>
                                    @endif
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out"></i>&nbsp;Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('components/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('components/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('components/momentjs/moment-with-locales.js') }}"></script>
    <script src="{{ asset('components/jquery-validation/jquery-validation.min.js') }}"></script>
    <script src="{{ asset('components/jquery-validation/jquery-validation.addon.min.js') }}"></script>
    <script src="{{ asset('components/metisMenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('components/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('components/morrisjs/morris.min.js') }}"></script>
    <script src="{{ asset('components/sb-admin-2/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('components/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('components/bootstrap-datatables/datatables-bootstrap.js') }}"></script>
    <script src="{{ asset('components/bootstrap-datepicker/js/datepicker.min.js') }}"></script>
    <script src="{{ asset('components/bootstrap-datepicker/locales/datepicker.it.min.js') }}"></script>
    <script src="{{ asset('components/bootstrap-datetimepicker/datetimepicker.min.js') }}"></script>
    <script src="{{ asset('components/sweetalert/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('components/select2/select2.min.js') }}"></script>
    <script src="{{ asset('components/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('components/fullcalendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('components/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    
    @yield('scripts')
    
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        
        tinymce.init({ 
            selector: 'textarea.tinymce' ,
            menubar: 'edit view format table tools',
            plugins: [
                'advlist lists textcolor searchreplace visualblocks fullscreen table contextmenu paste code help'
              ],
            toolbar1: 'undo redo | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table ',
        });
    </script>
    
</body>
</html>
