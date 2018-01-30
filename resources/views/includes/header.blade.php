<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">ESA</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto list-unstyled">
      <li class="nav-item active">
        <a class="nav-link {{Request::is('/') ? 'active' : ''}}" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
      </li>
      @if(Auth::user())
      <li class="nav-item">
        <a class="nav-link {{Request::is('dashboard') ? 'active' : ''}}" href="dashboard">Dashboard</a>
      </li>
      @endif
    </ul>
    <!--<form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>-->
    <ul class="navbar-nav navbar-right">
         <!--<li class="nav-item active">
           {{--@if(Auth::user())
               @if(Auth::user()->isAdmin())
                <a class="nav-link" href="{{route('account')}}">Account<span class="sr-only"></span></a>
               @endif
           @endif--}}

          </li>-->
        <li class="nav-item active">
           @if(Auth::user())
                <a class="nav-link" href="{{route('logout')}}">Logout <span class="sr-only"></span></a>
           @else
               <a class="nav-link" href="{{route('login')}}">Login<span class="sr-only">(current)</span></a>
           @endif
          </li>          
      </ul>
  </div>
</nav>
</header>