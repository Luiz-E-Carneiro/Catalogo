@extends('layouts.default_page')
@section('head')
    @vite(['resources/css/movie.css'])
@endsection
@section('content')
<main>
    <section id="movie" style="background-image: url({{asset("storage/".$movie->banner)}})">
        <div id="movie_description">
            <div id="movie_title">{{$movie->title}}</div>
            <div id="movie_data">
                <a href="{{route("movie.search", ["category" => $movie->category->id])}}" id="movie_category">{{$movie->category->name}}</a>
                <div id="movie_rate">
                    <p>{{$movie->rating}}/10</p>
                    <div>
                        @for ($i = 0; $i <= 4; $i++)
                            @if ($i <= ($movie["star_count"]-1))
                            <i class="fa-solid fa-star colored"></i>
                            @elseif ($movie["star_count"] == $i && $movie["star_count"] != $movie["custom_rating"])
                            <i class="fa-solid fa-star-half-stroke colored"></i>
                            @else
                            <i class="fa-regular fa-star"></i>
                            @endif
                        @endfor
                    </div>
                </div>
                <p>|</p>
                <div id="movie_date">{{$movie->category->name}}</div>
                <p>|</p>
                <div id="movie_publisher">{{$movie->publisher}}</div>
            </div>
            <div id="synopsis">{{$movie->synopsis}}</div>
            <div id="movie_buttons">
                <div id="watch">
                    <i class="fa-solid fa-play"></i>
                    <p>Watch Trailer</p>
                </div>
                <div id="save" class="save_button @if ($movie->is_wished()) saved @endif" data-movie_id="{{$movie->id}}">
                    <i class="fa-solid fa-bookmark"></i>
                    <p>@if ($movie->is_wished()) Saved on Wish List @else Save in Wish List @endif</p>
                </div>
                @if (Auth::check() && Auth::user()->role == "admin")
                    <div id="settings">
                        <i class="fa-solid fa-gear"></i>
                        <p>Settings</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
    @if (Auth::check() && Auth::user()->role == "admin")
        <div id="settings_window">
            <a href="{{route("movie.edit", $movie->id)}}">
                <i class="fa-solid fa-pen-to-square"></i>
                <p>Edit</p>
            </a>
            <a href="">
                <i class="fa-solid fa-trash"></i>
                <p>Delete</p>
            </a>
        </div>
    @endif
    <section id="all_movies" class="post_section">
        <div class="section_header">
            <h4>You might like</h4>
        </div>
        <div class="section_movies">
            @foreach ($related_movies as $movie)
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
    @if (!empty($wish_list))
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
</main>
<section id="movie_trailer" class="closed_movie">
    <!--https://www.youtube.com/embed/-IJuKT1mHO8-->
    <iframe id="trailer" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</section>
@endsection
@section('js')
    @vite(['resources/js/wish_list.js'])
    @vite(['resources/js/movie.js'])
@endsection
