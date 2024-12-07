<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Animate on Scroll -->
	<link 
    href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    {{-- css/js --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Market</title>
</head>
<body>
    <section class="header">
        <div class="container">
            <div class="flex">
                <div class="wrapper">
                    <div class="logo">
                        <a href="/"><i class="fa-solid fa-ghost"></i></i>MarketGhost</a>
                        <span class="hover-caption">Home</span>
                    </div>
                    <div class="burger"></div>
                    <div class="nav">    
                        <button id="close-nav"></button>
                        <ul class="nav-menu">
                            <div class="wrapper">
                                <li><x-nav-links href="/" :active="request()->is('/')">Home</x-nav-links></li>
                                <li><x-nav-links href="/listings/items" :active="request()->is('listings/items')">Items</x-nav-links></li>
                                <li><x-nav-links href="/listings/watchlist" :active="request()->is('listings/watchlist')">Watchlist</x-nav-links></li>
                            </div>
                            @guest
                            <div class="log-container"></div>
                            @endguest
                        </ul>
                    </div>
                </div>
                <div class="wrapper-icon">
                    @guest
                    <div class="log-container">
                        <div class="log">
                            <x-nav-links href="/login" :active="request()->is('login')">Log In</x-nav-links>
                            <x-nav-links href="/register" :active="request()->is('register')">Sign Up</x-nav-links>
                        </div>
                    </div>
                   @endguest
                        @auth
                            <button popovertarget="dropdown" class="user-btn">
                                <i class="fa-regular fa-user">
                                    <span class="hover-caption">user info</span>
                                </i>
                            </button>  
                            <div popover id="dropdown" class="dropdown">
                                <div class="item">
                                    <a href="/auth/edit">Profile</a>
                                </div>
                                <div class="item">
                                    <form method="POST" action="/logout">
                                        @csrf
                                        <button type="submit">Log Out</button>
                                    </form>
                                </div> 
                            </div>
                        @endauth
                        <div class="mode-toggle">
                            <i class="fa-regular fa-sun">
                                <span class="hover-caption">light mode</span>
                            </i>
                        </div>
                    </div>
                </div>
            <hr>
        </div> 
    </section>
    
        {{$slot}}  

    <footer>
       
    </footer>

    <!-- AOS js -->
    <script 
    src="https://unpkg.com/aos@2.3.1/dist/aos.js"
    ></script>
    
    <!-- JQUERY -->
    <script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
    ></script>
</body>
</html>