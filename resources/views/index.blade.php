@extends('layouts.default_page')
@section('head')
    @vite(['resources/css/home.css'])
@endsection
@section('content')
<main>
    <section id="main_movie" style="background-image: url({{asset("storage/banners/shrek.jpg")}})">
        <div id="movie_description">
            <a href="" id="movie_title">{{$first_movie->title}}</a>
            <a href="" id="movie_data">
                <div id="movie_category">{{$first_movie->category->name}}</div>
                <p>|</p>
                <div id="movie_date">{{$first_movie->year}}</div>
                <p>|</p>
                <div id="movie_rate">
                    <p>{{$first_movie->rating}}/10</p>
                    <div>
                        @for ($i = 0; $i <= 4; $i++)
                            @if ($i <= ($star_count-1))
                            <i class="fa-solid fa-star colored"></i>
                            @elseif ($star_count == $i && $star_count != $first_movie->rating)
                            <i class="fa-solid fa-star-half-stroke colored"></i>
                            @else
                            <i class="fa-regular fa-star"></i>
                            @endif
                        @endfor
                    </div>
                </div>
            </a>
            <a href="" id="synopsis">{{$first_movie->synopsis}}</a>
            <div id="movie_buttons">
                <a href="" id="watch">
                    <i class="fa-solid fa-play"></i>
                    <p>Watch Trailer</p>
                </a>
                <a href="" id="save">
                    <i class="fa-solid fa-bookmark"></i>
                    <p>Save in Wish List</p>
                </a>
            </div>
        </div>
    </section>
    <section class="post_section">
        <div class="section_header">
            <h4>In your Wish List</h4>
            <a href="">
                <p>See More</p>
                <i class="fa-solid fa-angle-right"></i>
            </a>
        </div>
        <div class="section_movies">
            <div class="movie">
                <a href="{{route("movie.show", 1)}}" class="movie_cover">
                    <button id="wish_list">
                        <i class="fa-regular fa-bookmark"></i>
                    </button>
                    <div class="movie_rate">
                        <p>5.5/10</p>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </a>
                <div class="movie_desc">
                    <a href="">
                        <h5>Avengers: End Game</h5>
                    </a>
                    <a href="">Action</a>
                </div>
            </div>
            <div class="movie">
                <a href="{{route("movie.show", 1)}}" class="movie_cover">
                    <button id="wish_list">
                        <i class="fa-regular fa-bookmark"></i>
                    </button>
                    <div class="movie_rate">
                        <p>5.5/10</p>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </a>
                <div class="movie_desc">
                    <a href="">
                        <h5>Avengers: End Game</h5>
                    </a>
                    <a href="">Action</a>
                </div>
            </div>
            <div class="movie">
                <a href="{{route("movie.show", 1)}}" class="movie_cover">
                    <button id="wish_list">
                        <i class="fa-regular fa-bookmark"></i>
                    </button>
                    <div class="movie_rate">
                        <p>5.5/10</p>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </a>
                <div class="movie_desc">
                    <a href="">
                        <h5>Avengers: End Game</h5>
                    </a>
                    <a href="">Action</a>
                </div>
            </div>
            <div class="movie">
                <a href="{{route("movie.show", 1)}}" class="movie_cover">
                    <button id="wish_list">
                        <i class="fa-regular fa-bookmark"></i>
                    </button>
                    <div class="movie_rate">
                        <p>5.5/10</p>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </a>
                <div class="movie_desc">
                    <a href="">
                        <h5>Avengers: End Game</h5>
                    </a>
                    <a href="">Action</a>
                </div>
            </div>
            <div class="movie">
                <a href="{{route("movie.show", 1)}}" class="movie_cover">
                    <button id="wish_list">
                        <i class="fa-regular fa-bookmark"></i>
                    </button>
                    <div class="movie_rate">
                        <p>5.5/10</p>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </a>
                <div class="movie_desc">
                    <a href="">
                        <h5>Avengers: End Game</h5>
                    </a>
                    <a href="">Action</a>
                </div>
            </div>
        </div>
    </section>
    <section class="post_section">
        <div class="section_header">
            <h4>Week Trending</h4>
            <a href="">
                <p>See More</p>
                <i class="fa-solid fa-angle-right"></i>
            </a>
        </div>
        <div class="section_movies">
            <div class="movie">
                <a href="{{route("movie.show", 1)}}" class="movie_cover">
                    <button id="wish_list">
                        <i class="fa-regular fa-bookmark"></i>
                    </button>
                    <div class="movie_rate">
                        <p>5.5/10</p>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </a>
                <div class="movie_desc">
                    <a href="">
                        <h5>Avengers: End Game</h5>
                    </a>
                    <a href="">Action</a>
                </div>
            </div>
            <div class="movie">
                <a href="{{route("movie.show", 1)}}" class="movie_cover">
                    <button id="wish_list">
                        <i class="fa-regular fa-bookmark"></i>
                    </button>
                    <div class="movie_rate">
                        <p>5.5/10</p>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </a>
                <div class="movie_desc">
                    <a href="">
                        <h5>Avengers: End Game</h5>
                    </a>
                    <a href="">Action</a>
                </div>
            </div>
            <div class="movie">
                <a href="{{route("movie.show", 1)}}" class="movie_cover">
                    <button id="wish_list">
                        <i class="fa-regular fa-bookmark"></i>
                    </button>
                    <div class="movie_rate">
                        <p>5.5/10</p>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </a>
                <div class="movie_desc">
                    <a href="">
                        <h5>Avengers: End Game</h5>
                    </a>
                    <a href="">Action</a>
                </div>
            </div>
            <div class="movie">
                <a href="{{route("movie.show", 1)}}" class="movie_cover">
                    <button id="wish_list">
                        <i class="fa-regular fa-bookmark"></i>
                    </button>
                    <div class="movie_rate">
                        <p>5.5/10</p>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </a>
                <div class="movie_desc">
                    <a href="">
                        <h5>Avengers: End Game</h5>
                    </a>
                    <a href="">Action</a>
                </div>
            </div>
            <div class="movie">
                <a href="{{route("movie.show", 1)}}" class="movie_cover">
                    <button id="wish_list">
                        <i class="fa-regular fa-bookmark"></i>
                    </button>
                    <div class="movie_rate">
                        <p>5.5/10</p>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </a>
                <div class="movie_desc">
                    <a href="">
                        <h5>Avengers: End Game</h5>
                    </a>
                    <a href="">Action</a>
                </div>
            </div>
        </div>
    </section>
    <section id="all_movies" class="post_section">
        <div class="section_header">
            <h4>All movies</h4>
        </div>
        <div class="section_movies">
            <div class="movie">
                <a href="{{route("movie.show", 1)}}" class="movie_cover">
                    <button id="wish_list">
                        <i class="fa-regular fa-bookmark"></i>
                    </button>
                    <div class="movie_rate">
                        <p>5.5/10</p>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </a>
                <div class="movie_desc">
                    <a href="">
                        <h5>Avengers: End Game</h5>
                    </a>
                    <a href="">Action</a>
                </div>
            </div>
            <div class="movie">
                <a href="{{route("movie.show", 1)}}" class="movie_cover">
                    <button id="wish_list">
                        <i class="fa-regular fa-bookmark"></i>
                    </button>
                    <div class="movie_rate">
                        <p>5.5/10</p>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </a>
                <div class="movie_desc">
                    <a href="">
                        <h5>Avengers: End Game</h5>
                    </a>
                    <a href="">Action</a>
                </div>
            </div>
            <div class="movie">
                <a href="{{route("movie.show", 1)}}" class="movie_cover">
                    <button id="wish_list">
                        <i class="fa-regular fa-bookmark"></i>
                    </button>
                    <div class="movie_rate">
                        <p>5.5/10</p>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </a>
                <div class="movie_desc">
                    <a href="">
                        <h5>Avengers: End Game</h5>
                    </a>
                    <a href="">Action</a>
                </div>
            </div>
            <div class="movie">
                <a href="{{route("movie.show", 1)}}" class="movie_cover">
                    <button id="wish_list">
                        <i class="fa-regular fa-bookmark"></i>
                    </button>
                    <div class="movie_rate">
                        <p>5.5/10</p>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </a>
                <div class="movie_desc">
                    <a href="">
                        <h5>Avengers: End Game</h5>
                    </a>
                    <a href="">Action</a>
                </div>
            </div>
            <div class="movie">
                <a href="{{route("movie.show", 1)}}" class="movie_cover">
                    <button id="wish_list">
                        <i class="fa-regular fa-bookmark"></i>
                    </button>
                    <div class="movie_rate">
                        <p>5.5/10</p>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </a>
                <div class="movie_desc">
                    <a href="">
                        <h5>Avengers: End Game</h5>
                    </a>
                    <a href="">Action</a>
                </div>
            </div>
            <div class="movie">
                <a href="{{route("movie.show", 1)}}" class="movie_cover">
                    <button id="wish_list">
                        <i class="fa-regular fa-bookmark"></i>
                    </button>
                    <div class="movie_rate">
                        <p>5.5/10</p>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </a>
                <div class="movie_desc">
                    <a href="">
                        <h5>Avengers: End Game</h5>
                    </a>
                    <a href="">Action</a>
                </div>
            </div>
            <div class="movie">
                <a href="{{route("movie.show", 1)}}" class="movie_cover">
                    <button id="wish_list">
                        <i class="fa-regular fa-bookmark"></i>
                    </button>
                    <div class="movie_rate">
                        <p>5.5/10</p>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </a>
                <div class="movie_desc">
                    <a href="">
                        <h5>Avengers: End Game</h5>
                    </a>
                    <a href="">Action</a>
                </div>
            </div>
            <div class="movie">
                <a href="{{route("movie.show", 1)}}" class="movie_cover">
                    <button id="wish_list">
                        <i class="fa-regular fa-bookmark"></i>
                    </button>
                    <div class="movie_rate">
                        <p>5.5/10</p>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </a>
                <div class="movie_desc">
                    <a href="">
                        <h5>Avengers: End Game</h5>
                    </a>
                    <a href="">Action</a>
                </div>
            </div>
            <div class="movie">
                <a href="{{route("movie.show", 1)}}" class="movie_cover">
                    <button id="wish_list">
                        <i class="fa-regular fa-bookmark"></i>
                    </button>
                    <div class="movie_rate">
                        <p>5.5/10</p>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </a>
                <div class="movie_desc">
                    <a href="">
                        <h5>Avengers: End Game</h5>
                    </a>
                    <a href="">Action</a>
                </div>
            </div>
            <div class="movie">
                <a href="{{route("movie.show", 1)}}" class="movie_cover">
                    <button id="wish_list">
                        <i class="fa-regular fa-bookmark"></i>
                    </button>
                    <div class="movie_rate">
                        <p>5.5/10</p>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </a>
                <div class="movie_desc">
                    <a href="">
                        <h5>Avengers: End Game</h5>
                    </a>
                    <a href="">Action</a>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
