<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laravel 8</title>
 <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    
	
	
	
	
  <div class="container">
  
	<nav class="navbar navbar-expand-md navbar-light bg-lblue shadow-sm"">
  
	<!-- Example single danger button -->
<div class="btn-group">
  <button type="button" class="btn btn-primary  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Produkty
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="{{ route('produkty.index')}}">Wyświetl produkty</a>
    <a class="dropdown-item" href="{{ route('produkty.create')}}">Dodaj produkt</a>
    <a class="dropdown-item" href="#">Something else here</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#">Separated link</a>
  </div>
</div>
/\
<div class="btn-group">
  <button type="button" class="btn btn-primary  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Kontrahenci
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="{{ route('kontrahenci.index')}}">Wyświetl Kontrahentów</a>
    <a class="dropdown-item" href="{{ route('kontrahenci.create')}}">Importuj Kontrahentów</a>
    <a class="dropdown-item" href="#">Ustaw cene dla Kontrahenta</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#">Separated link</a>
  </div>
</div>
/\
<div class="btn-group">
  <button type="button" class="btn btn-primary  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Kategorie
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="{{ route('produkty.create')}}">Wyświetl kategorie</a>
    <a class="dropdown-item" href="{{ route('produkty.create')}}">Dodaj kategorie</a>
    <a class="dropdown-item" href="#">Something else here</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#">Separated link</a>
  </div>
</div>
/\
<div class="btn-group">
  <button type="button" class="btn btn-primary  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Producenci
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="{{ route('producenci.index')}}">Wyświetl producentów</a>
    <a class="dropdown-item" href="{{ route('producenci.create')}}">Dodaj producenta</a>
    <a class="dropdown-item" href="#">Something else here</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#">Separated link</a>
  </div>
</div>


</nav>





    @yield('main')
  </div>
  <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>