<html>
 <head>
  <title>
   Daftar Produk
  </title>
  <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>    
 <body>
    <div class="admin">
        <div class="d-flex">
         <div class="sidebar">
          <h4>
           SIMS Web App
          </h4>
          <a href="/dashboard">
           <i class="fas fa-box">
           </i>
           Produk
          </a>
          <a href="/profile">
           <i class="fas fa-user">
           </i>
           Profil
          </a>
          <a  href="{{ route('logout') }}"  onclick="event.preventDefault();document.getElementById('logout-form').submit();"{{ __('Logout') }}>
           <i class="fas fa-sign-out-alt">
           </i>
           Logout
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> @csrf
          </form>
         </div>
              <div class="content flex-grow-1">
                  @yield('content')
              </div>
        </div>  
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
 </body>
</html>
