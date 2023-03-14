<nav class="navbar bg-dark navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('home') }}">{{__('home')}}</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ route('userDocument.create') }}">Add UserDocument</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ route('userDocument.index') }}">Show UserDocument</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ route('document.create') }}">Add Document</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ route('document.index') }}">Show Document</a>
        </li>


        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle text-success" data-bs-toggle="dropdown" aria-expanded="false">
              welcome, {{auth()->user()->name}}
            </a>
            <ul class="dropdown-menu">
              <li>
                  @auth
                    <li class="nav-item">
                      <a class="dropdown-item" href="{{route('logout')}}">{{__('logout')}}</a>
                    </li>
                  @endauth
              </li>
            </ul>
        </li>
    </div>
  </div>
</nav>