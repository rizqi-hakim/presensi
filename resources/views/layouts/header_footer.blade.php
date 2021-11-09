<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <title>Hello, world!</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            @if (Auth::user()->role == 0)
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('sakit') }}">Izin Sakit</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('cuti') }}">Izin Cuti</a>
              </li>
            @else
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('approval') }}">Daftar Pengajuan Izin</a>
              </li>
            @endif
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="{{ route('report') }}">Laporan</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  {{ Auth::user()->name }}
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                   {{ __('Logout') }}
               </a></li>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    @yield('main-section')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src='{{ asset('assets/js/jquery-3.0.0.js') }}' type='text/javascript'></script>
    <script src='{{ asset('assets/js/jquery-ui.min.js') }}' type='text/javascript'></script>
    @yield('script')
</body>
</html>