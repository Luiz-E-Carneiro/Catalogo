@extends('layouts.default_page')
@section('head')
    @vite(['resources/css/search.css'])
@endsection
@section('content')
<main>
    <div id="page_title">
        <h1>Results for you search</h1>
        <p>It is never to late to find a new work of art</p>
    </div>
    <form action="" method="get" id="main_search">
        <label for="search">
            <i class="fa-solid fa-magnifying-glass"></i>
        </label>
        <input type="text" id="search" name="text" value="{{$text ?? ""}}" placeholder="Search for something...">
        <input type="hidden" name="search_text" value="{{$filter[0] ?? 0}}">
        <input type="hidden" name="order_by" value="{{$filter[2] ?? 0}}">
        <input type="hidden" name="category" value="{{$filter[1] ?? 0}}">
        <div>
            <button type="button" id="filter_button">
                <i class="fa-solid fa-sliders"></i>
                <p>Filter</p>
            </button>
            <button type="submit" id="search_button"><p>Search</p></button>
        </div>
    </form>
    <section id="all_movies" class="post_section">
        <div class="section_movies">
            @foreach ($movies as $movie)
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
<div id="filter_window">
    <div id="filter_header">
        <h2>Filter your results</h2>
        <button><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div id="filter_body">
        <div class="filter_option">
            <h3>Search for</h3>
            <select id="search_text">
                <option value="0">All</option>
                <option value="1" @if (($filter[0] ?? 0) == 1) selected @endif>Title</option>
                <option value="2" @if (($filter[0] ?? 0) == 2) selected @endif>Synopsis</option>
                <option value="3" @if (($filter[0] ?? 0) == 3) selected @endif>Publisher</option>
            </select>
        </div>
        <div class="filter_option">
            <h3>Order by</h3>
            <select id="order_by">
                <option value="0">Nothing</option>
                <option value="1" @if (($filter[2] ?? 0) == 1) selected @endif>Lauch Year</option>
                <option value="2" @if (($filter[2] ?? 0) == 2) selected @endif>Rating</option>
                <option value="3" @if (($filter[2] ?? 0) == 3) selected @endif>Saves on Wish List</option>
            </select>
        </div>
        <div class="filter_option">
            <h3>Category</h3>
            <select id="category">
                <option value="0">All</option>
                @foreach ($categories as $category)
                <option value="{{$category["id"]}}" @if (($filter[1] ?? 0) == $category["id"]) selected @endif>{{$category["name"]}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div id="filter_buttons">
        <div id="cancel_button">Cancel</div>
        <div id="submit_button">Apply</div>
    </div>
</div>
@endsection
@section('js')
    @vite(['resources/js/wish_list.js'])
    @vite(['resources/js/search.js'])
@endsection
