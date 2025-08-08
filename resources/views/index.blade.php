@extends('layouts.default_page')
@section('head')
    @vite(['resources/css/index.css'])
@endsection
@section('content')
    <header>
        <div>
            <a id="logo" href="">
                <img src="{{asset("system/white_icon.svg")}}" alt="">
            </a>
            <nav>
                <a href="">
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
                <a href="">
                    <i class="fa-solid fa-clapperboard"></i>
                    <p>Add a movie</p>
                </a>
            </nav>
        </div>
        <div>
            <form id="search_input" method="get" action="" class="closed">
                <input type="">
                <button type="submit" id="submit_search"><i class="fa-solid fa-magnifying-glass"></i></button>
                <button type="button" id="search_button"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <button><i class="fa-solid fa-moon"></i></button>
            <div id="profile_button" style="background-image: url({{asset(Auth::check() ? Auth::user()->profile : "system/default_profile.svg")}})"></div>
        </div>
    </header>
@endsection
