@include("../components/layout_main_header") 

   	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="{{ URL::to('/') }}">
                  {{ config('app.name') }}
                </a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
		  <ul class="navbar-nav mr-auto">
		      <li class="nav-item active">
		        <a class="nav-link" href="{{ URL::to('home') }}">Home </a>
		      </li>
                       @if(Auth::user()->can('index.user'))  
		      <li class="nav-item">
		        <a class="nav-link" href="{{ URL::to('user') }}">User</a>
		      </li>
                      @endif
                      
                      @if(Auth::user()->can('index.role'))
                      <li class="nav-item">
                        <a class="nav-link" href="{{ URL::to('role') }}">Role</a>
                      </li>
                      @endif
                      
                      @if(Auth::user()->can('index.permission'))  
                      <li class="nav-item">
                        <a class="nav-link" href="{{ URL::to('permission') }}">Permission</a>
                      </li>
                      @endif
		  </ul>   
                  <ul class="navbar-nav pull-right">
                      <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                  </ul>   

	  	</div>
	</nav>

	<div class="container-fluid">
	    @yield('content')	
	</div>

@include("../components/layout_main_footer") 