@extends('layouts.default_page')
@section('head')
    @vite(['resources/css/home.css'])
@endsection
@section('content')
<main>
    <section id="main_movie" style="background-image: url({{asset("storage/banners/shrek.jpg")}})">
        <div id="movie_description">
            <a href="{{route("movie.show", $popular_movies[0]->id)}}" id="movie_title">{{$popular_movies[0]->title}}</a>
            <a href="{{route("movie.show", $popular_movies[0]->id)}}" id="movie_data">
                <div id="movie_category">{{$popular_movies[0]->category->name}}</div>
                <p>|</p>
                <div id="movie_date">{{$popular_movies[0]->year}}</div>
                <p>|</p>
                <div id="movie_rate">
                    <p>{{$popular_movies[0]->rating}}/10</p>
                    <div>
                        @for ($i = 0; $i <= 4; $i++)
                            @if ($i <= ($popular_movies[0]["star_count"]-1))
                            <i class="fa-solid fa-star colored"></i>
                            @elseif ($popular_movies[0]["star_count"] == $i && $popular_movies[0]["star_count"] != $popular_movies[0]["custom_rating"])
                            <i class="fa-solid fa-star-half-stroke colored"></i>
                            @else
                            <i class="fa-regular fa-star"></i>
                            @endif
                        @endfor
                    </div>
                </div>
            </a>
            <a href="{{route("movie.show", $popular_movies[0]->id)}}" id="synopsis">{{$popular_movies[0]->synopsis}}</a>
            <div id="movie_buttons">
                <a href="{{$popular_movies[0]->link}}" id="watch" target="_blank">
                    <i class="fa-solid fa-play"></i>
                    <p>Watch Trailer</p>
                </a>
                <div id="save" class="save_button @if ($popular_movies[0]->is_wished()) saved @endif" data-movie_id="{{$popular_movies[0]->id}}">
                    <i class="fa-solid fa-bookmark"></i>
                    <p>@if ($popular_movies[0]->is_wished()) Saved on Wish List @else Save in Wish List @endif</p>
                </div>
            </div>
        </div>
    </section>
    @if (Auth::check() && !$wish_list->isEmpty())
        <section class="post_section">
            <div class="section_header">
                <h4>In your Wish List</h4>
                <a href="{{route("user.index", Auth::user()->id)}}">
                    <p>See More</p>
                    <i class="fa-solid fa-angle-right"></i>
                </a>
            </div>
            <div class="section_movies">
                @foreach ($wish_list as $movie)
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
    @endif
    <section class="post_section">
        <div class="section_header">
            <h4>Week Trending</h4>
            <a href="">
                <p>See More</p>
                <i class="fa-solid fa-angle-right"></i>
            </a>
        </div>
        <div class="section_movies">
            @foreach ($popular_movies as $movie)
                @if ($movie->id != $popular_movies[0]->id)
                    <div class="movie">
                        <a href="{{route("movie.show", $movie->id)}}" style="background-image: url({{asset("storage/")."/".$movie->cover}});" class="movie_cover">
                            <button id="wish_list" class="save_button @if ($movie->is_wished()) saved @endif" data-movie_id="{{$movie->id}}">
                                @if ($movie->is_wished())
                                <i class="fa-solid fa-bookmark"></i>
                                @else
                                <i class="fa-regular fa-bookmark"></i>
                                @endif
                            </button>
                            <div class="movie_rate">
                                <p>{{$movie->rating}}/10</p>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </a>
                        <div class="movie_desc">
                            <a href="">
                                <h5>{{$movie->title}}</h5>
                            </a>
                            <a href="">{{$movie->category->name}}</a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
    <section id="all_movies" class="post_section">
        <div class="section_header">
            <h4>All movies</h4>
        </div>
        <div class="section_movies">
            @foreach ($all_movies as $movie)
            <div class="movie">
                <a href="{{route("movie.show", $movie->id)}}" style="background-image: url({{asset("storage/")."/".$movie->cover}});" class="movie_cover">
                    <button id="wish_list" class="save_button @if ($movie->is_wished()) saved @endif" data-movie_id="{{$movie->id}}">
                        @if ($movie->is_wished())
                        <i class="fa-solid fa-bookmark"></i>
                        @else
                        <i class="fa-regular fa-bookmark"></i>
                        @endif
                    </button>
                    <div class="movie_rate">
                        <p>{{$movie->rating}}/10</p>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </a>
                <div class="movie_desc">
                    <a href="">
                        <h5>{{$movie->title}}</h5>
                    </a>
                    <a href="">{{$movie->category->name}}</a>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</main>
@endsection
@section('js')
    @vite(['resources/js/wish_list.js'])
@endsection
