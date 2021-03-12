<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

	
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GroundedStorks') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/pretty.css') }}" rel="stylesheet">    <!-- New Sheet for easily adding CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'GroundedStorks') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
					
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                   
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
 	
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    
                              		 <a class="dropdown-item" href="account"> <!-- New Dropdown 2/5/21 -->
                                        Account
                                    </a>
                                    
                                    <a class="dropdown-item" href="portfolio"> <!-- New Dropdown 2/5/21 -->
                                        My Portfolio
                                    </a>
                                  	<a class="dropdown-item" href="group"> <!-- New Dropdown 2/28/21 -->
                                     	Groups
                                    </a>
                             		<a class="dropdown-item" href="searchJob"> <!-- New Dropdown 3/8/21 -->
                                     	Search Jobs
                                    </a>
                                 	@if(Auth::user()->getRoleAttribute(Auth::user()->email) == "admin")             
                                   	<a class="dropdown-item" href="job"> <!-- New Dropdown 2/20/21 -->
                                            Post Job
                                        </a>
                                            <!-- If user is admin then show admin page -->             
                                                              

                                    
                                   		<a class="dropdown-item" href="admin"> <!-- New Dropdown 2/5/21 -->
                                        	Admin
                                    	</a>
                                    @endif
                                </div> <!-- End of the dropdown -->
                                
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    
    <!--Footer-->
    <div class="footstuff">
	<footer>
    		<small><i>Copyright 2021 GroundedStorks</i></small>	
    			
    </footer>
    </div>
    
</body>
</html>
