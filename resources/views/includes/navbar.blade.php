<nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand page-scroll" href="#page-top">DogSite</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>           
                <li id='home'>
                    <a class="page-scroll" href="{{url('/')}}">Home</a>
                </li> 
                @if(!(strpos($_SERVER['REQUEST_URI'], '/profile') !== false))
                  <li>
                      <a class="page-scroll" href="#portfolio">Breeds</a>
                  </li>
                  <li>
                      <a class="page-scroll" href="#contact">Contact</a>
                  </li>            
                @endif                      
                @guest 
                  <li>
                      <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                  </li>
                  <li>
                      <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                  </li>
                @else
                  <li class="@if(strpos($_SERVER['REQUEST_URI'], '/dogs/create') !== false){{'activee'}}@else{{''}}@endif"><a href="{{url('/dogs/create')}}">Create Breed</a></li>
                  <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ Auth::user()->name }} <span class="caret"></span>
                      </a>

                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                          <a class="page-scroll dropdown-link" href="{{url('/profile')}}">Profile</a>
                          <a class="dropdown-item dropdown-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                          </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                      </div>
                  </li>
                @endguest

                
                
                {{-- <li class="@if(strpos($_SERVER['REQUEST_URI'], 'dogs') !== false && !strpos($_SERVER['REQUEST_URI'], 'dogs/create') !== false){{'active'}}@else{{''}}@endif">
                  <a href="{{url('/dogs/create')}}">Create Breed</a>
                </li> --}}
                
                
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>