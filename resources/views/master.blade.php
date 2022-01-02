<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>{{ $title }} | Sistorage</title>

  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="/css/sweetalert2.min.css">
</head>
<body>
  
<script 
src="https://code.jquery.com/jquery-3.6.0.min.js" 
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
crossorigin="anonymous">
</script>

    @if (!(Request::is('login') || Request::is('register')))
      @include('partials.navbar')
      @include('partials.sidebar')
      <main id="main">
        @yield('content')
      </main>
    @else 
      @yield('auth')
    @endif

    @include('sweetalert::alert')


  <script type="module" src="{{ asset('js/app.js') }}"></script>
  @stack('data-table')
<script src="/js/sweetalert2.all.min.js"></script>
<script src="/js/sweetalert2.min.js"></script>
</body>
</html>
