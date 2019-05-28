
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title> @yield('title') </title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="{{asset('mdb/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="{{asset('mdb/css/mdb.min.css')}}" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="{{asset('mdb/css/style.min.css')}}" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="{{asset('DataTables/datatables.css')}}" rel="stylesheet">
  <!-- Alertify  -->
  <link rel="stylesheet" href="{{asset('alertifyjs/css/alertify.min.css')}}"/>

  <style>
    .map-container{
    overflow:hidden;
    padding-bottom:56.25%;
    position:relative;
    height:0;
    }
    .map-container iframe{
    left:0;
    top:0;
    height:100%;
    width:100%;
    position:absolute;
    }
  </style>
</head>

<body class="grey lighten-3">

  <!--Main Navigation-->
  <header>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
      <div class="container-fluid">

        <!-- Brand -->
        <a class="navbar-brand waves-effect" href="{{ URL('/') }}">
          <small><strong class="blue-text">CSD</strong></small>
        </a>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <!-- Left -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ (request()->is('documentos/inicio'))?'active':'' }}">
              <a class="nav-link waves-effect" href="{{ URL('/') }}">INICIO</a>
            </li>
            @if(\Auth::User()->type == "almacenista" || \Auth::User()->type == "administrador")
            <li class="nav-item {{ (request()->is('documentos/documentos'))?'active':'' }}">
              <a class="nav-link waves-effect" href="{{ URL('/documentos/documentos') }}">DOCUMENTOS</a>
            </li>
            <li class="nav-item {{ (request()->is('documentos/areas'))?'active':'' }}">
              <a class="nav-link waves-effect" href="{{ URL('/documentos/areas') }}">AREAS</a>
            </li>
            <li class="nav-item {{ (request()->is('documentos/lugares'))?'active':'' }}">
              <a class="nav-link waves-effect" href="{{ URL('/documentos/lugares') }}">LUGARES</a>
            </li>
            <li class="nav-item {{ (request()->is('documentos/entradas'))?'active':'' }}">
              <a class="nav-link waves-effect" href="{{ URL('/documentos/entradas') }}">ENTRADAS</a>
            </li>
            <li class="nav-item {{ (request()->is('documentos/salidas'))?'active':'' }}">
              <a class="nav-link waves-effect" href="{{ URL('/documentos/salidas') }}">SALIDAS</a>
            </li>
            <li class="nav-item {{ (request()->is('documentos/reportes'))?'active':'' }}">
              <a class="nav-link waves-effect" href="{{ URL('/documentos/reportes') }}">REPORTES</a>
            </li>
            @endif
            @if(\Auth::User()->type == "administrador")
            <li class="nav-item {{ (request()->is('documentos/bitacora'))?'active':'' }}">
              <a class="nav-link waves-effect" href="{{ URL('/documentos/bitacora') }}">BITACORA</a>
            </li>
            <li class="nav-item {{ (request()->is('documentos/usuarios'))?'active':'' }}">
              <a class="nav-link waves-effect" href="{{ URL('/documentos/usuarios') }}">USUARIOS</a>
            </li>
            @endif

          </ul>
          <!-- Right -->
          <ul class="navbar-nav nav-flex-icons">
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('ACCEDER') }}</a>
            </li>
            @else
            <li class="nav-item">
              <a href="{{ route('logout') }}"  class="nav-link border border-light rounded waves-effect" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('SALIR') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </li>
            @endguest
          </ul>

        </div>

      </div>
    </nav>
    <!-- Navbar -->

    <!-- Sidebar -->
    <div class="sidebar-fixed position-fixed">

      <a class="logo-wrapper waves-effect"  href="{{ URL('/') }}">
        <img src="{{ asset('dag.png') }}" width="200px" height="200px" class="img-fluid" alt="">
      </a>

      <div class="list-group list-group-flush">
        <a href="{{ URL('/') }}" class="list-group-item list-group-item-action waves-effect">
          <i class="fas fa-chart-pie mr-3"></i>INICIO
        </a>
        <a href="" class="list-group-item list-group-item-action waves-effect">
          <i class="fas fa-table mr-3"></i>DOCUMENTOS</a>

        <a href="" class="list-group-item list-group-item-action waves-effect">
          <i class="fas fa-table mr-3"></i>AREAS</a>

        <a href="" class="list-group-item list-group-item-action waves-effect">
          <i class="fas fa-table mr-3"></i>LUGARES</a>

        <a href="" class="list-group-item list-group-item-action waves-effect">
          <i class="fas fa-table mr-3"></i>ENTRADAS</a>

        <a href="" class="list-group-item list-group-item-action waves-effect">
          <i class="fas fa-map mr-3"></i>SALIDAS</a>

        <a href="" class="list-group-item list-group-item-action waves-effect">
          <i class="fas fa-money-bill-alt mr-3"></i>REPORTES</a>
      </div>

    </div>
    <!-- Sidebar -->
  </header>
  <!--Main Navigation-->

  <!--Main layout-->
  <main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">
      @yield('content')
    </div>
  </main>
  <!--Main layout-->

  <!--Footer-->
  <footer class="page-footer text-center font-small primary-color-dark darken-2 mt-4 wow fadeIn">
    <!--Copyright-->
    <div class="footer-copyright py-3">
      © 2019 Copyright:
      <a href="{{ route('autor') }}" target="_blank"> DIRECCIÓN DE INFORMATICA - UNERG </a>
    </div>
    <!--/.Copyright-->
  </footer>
  <!--/.Footer-->

  <!-- JQuery -->
  <script type="text/javascript" src="{{asset('mdb/js/jquery-3.3.1.min.js')}}"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="{{asset('mdb/js/popper.min.js')}}"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="{{asset('mdb/js/bootstrap.min.js')}}"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="{{asset('mdb/js/mdb.min.js')}}"></script>
  <!-- Axios -->
  <script type="text/javascript" src="{{asset('js/axios.min.js')}}"></script>
  <!-- MDBootstrap Datatables  -->
  <script type="text/javascript" src="{{asset('DataTables/datatables.js')}}"></script>
  <!-- alertify  -->
  <script type="text/javascript" src="{{asset('alertifyjs/alertify.js')}}"></script>

  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();
  </script>

  {{-- <script type="text/javascript">
    $(document).ready(function() {
        var table = $('#tb').DataTable();
    });
  </script> --}}

  @yield('my-js')

</body>

</html>
