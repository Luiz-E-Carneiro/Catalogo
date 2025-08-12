<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="{{asset("system/icon.svg")}}">
    @vite(['resources/css/index.css'])
    <title>Capybara Cinema</title>
    @yield('head')
</head>
<body>
    <header>
        <a id="logo" href="{{route("index")}}">
            <img src="{{asset("system/white_icon.svg")}}" alt="">
        </a>
        <nav>
            <a href="{{route("index")}}">
                <i class="fa-solid fa-house"></i>
                <p>Home</p>
            </a>
            <a href="">
                <i class="fa-solid fa-film"></i>
                <p>Recent Added</p>
            </a>
            <a href="">
                <i class="fa-solid fa-fire"></i>
                <p>Popular</p>
            </a>
            @if (Auth::check() && Auth::user()->role == "admin")
                <a href="{{route("movie.create")}}">
                    <i class="fa-solid fa-clapperboard"></i>
                    <p>Add a movie</p>
                </a>
            @endif
        </nav>
        <div id="right_header"> 
            <button type="button" id="search_button"><i class="fa-solid fa-magnifying-glass"></i></button>
            <button type="button" id="dark_mode"><i class="fa-solid fa-moon"></i></button>
            <div id="profile_button" style="background-image: url({{asset("storage/". (Auth::check() ? Auth::user()->profile : "users/default_profile.svg"))}})"></div>
        </div>
    </header>
    <div id="profile_dropdown" class="closed">
        @if (Auth::check())
        <a href="{{route("user.index", Auth::user()->id)}}">
            <i class="fa-solid fa-user"></i>
            <p>Your Profile</p>
        </a>
        <div>
            <i class="fa-solid fa-moon"></i>
            <p>Dark Mode</p>
        </div>
        <a href="{{route("logout")}}">
            <i class="fa-solid fa-right-from-bracket"></i>
            <p>Logout</p>
        </a>
        @else
        <a href="{{route("login")}}">
            <p>Sign in</p>
        </a>
        <a href="{{route("logon")}}">
            <p>New account</p>
        </a>
        @endif
    </div>
    <form id="search_input" method="get" action="{{route("movie.search")}}" class="closed">
        <input type="text" name="text" value="{{$text ?? ""}}">
        <button type="submit" id="submit_search"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
    @yield('content')
    @yield('js')
    @vite(['resources/js/index.js'])
</body>
</html>