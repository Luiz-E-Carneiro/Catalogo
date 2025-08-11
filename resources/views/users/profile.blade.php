@extends('layouts.default_page')
@section('head')
    @vite(['resources/css/profile.css'])
@endsection
@section('content')
<main>
    <section id="profile_header">
        <div id="profile_banner"></div>
        <div id="profile_data">
            <div>
                <div id="profile_photo" style="background-image: url({{asset("storage/".$user->profile)}})"></div>
                <div id="profile_fields">
                    <p id="profile_name">{{$user->name}}</p>
                    <p id="profile_email">{{$user->email}}</p>
                    <p id="profile_date">Since {{$user->create_date()}}</p>
                </div>
            </div>
            <div>
                <div id="profile_settings"><i class="fa-solid fa-gear"></i></div>
            </div>
        </div>
    </section>
    <section id="all_movies" class="post_section">
        <div class="section_header">
            <i class="fa-solid fa-bookmark"></i>
            <h4>Your Wish List</h4>
        </div>
        <div class="section_movies">
            @foreach ($user->wish_list as $movie)
            <div class="movie">
                <a href="{{route("movie.show", $movie->movie->id)}}" style="background-image: url({{asset("storage/")."/".$movie->movie->cover}});" class="movie_cover">
                    <button id="wish_list" class="save_button @if ($movie->movie->is_wished()) saved @endif" data-movie_id="{{$movie->movie->id}}">
                        @if ($movie->movie->is_wished())
                        <i class="fa-solid fa-bookmark"></i>
                        @else
                        <i class="fa-regular fa-bookmark"></i>
                        @endif
                    </button>
                    <div class="movie_rate">
                        <p>{{$movie->movie->rating}}/10</p>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </a>
                <div class="movie_desc">
                    <a href="">
                        <h5>{{$movie->movie->title}}</h5>
                    </a>
                    <a href="">{{$movie->movie->category->name}}</a>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</main>
<div id="settings_window">
    <a href="">
        <i class="fa-solid fa-pen-to-square"></i>
        <p>Edit</p>
    </a>
    <a href="">
        <i class="fa-solid fa-trash"></i>
        <p>Delete</p>
    </a>
</div>
@endsection
@section('js')
    @vite(['resources/js/wish_list.js'])
    @vite(['resources/js/profile.js'])
@endsection
