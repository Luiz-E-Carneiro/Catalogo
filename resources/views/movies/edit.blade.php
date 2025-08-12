@extends('layouts.default_page')
@section('head')
    @vite(['resources/css/form.css'])
@endsection
@section('content')
<main>
    <section id="page_title">
        <h1>Edit a movie</h1>
        <p>Update the fields to edit the movie</p>
    </section>
    <form action="{{route("movie.update")}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <input type="hidden" name="id" value="{{$movie->id}}">
        <div class="input_group">
            <div class="input @error("title") error @enderror">
                <label for="title">Title</label>
                <input value="{{$movie->title}}" type="text" name="title" id="title">
                @error("title")
                <p>{{$message}}</p>
                @else
                <p></p>
                @enderror
            </div>
            <div class="input @error("publisher") error @enderror">
                <label for="publisher">Publisher</label>
                <input value="{{$movie->publisher}}" type="text" name="publisher" id="publisher">
                @error("publisher")
                <p>{{$message}}</p>
                @else
                <p></p>
                @enderror
            </div>
        </div>
        <div class="input_group">
            <div class="input @error("year") error @enderror">
                <label for="year">Lauch year</label>
                <input value="{{$movie->year}}" type="number" min="0" step="1" name="year" id="year">
                @error("year")
                <p>{{$message}}</p>
                @else
                <p></p>
                @enderror
            </div>
            <div class="input @error("rating") error @enderror">
                <label for="rating">Rating (0.0 - 10.0)</label>
                <input value="{{$movie->rating}}" type="number" min="0" step="0.1" max="10" name="rating" id="rating">
                @error("rating")
                <p>{{$message}}</p>
                @else
                <p></p>
                @enderror
            </div>
        </div>
        <div class="input_group">
            <div class="input @error("category_id") error @enderror">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id">
                    @foreach ($categories as $category)
                        <option value="{{$category["id"]}}" @if ($movie->category->id == $category["id"])
                        selected
                        @endif>{{$category["name"]}}</option>
                    @endforeach
                </select>
                @error("category_id")
                <p>{{$message}}</p>
                @else
                <p></p>
                @enderror
            </div>
            <div class="input @error("link") error @enderror">
                <label for="link">Trailer Link</label>
                <input value="{{$movie->link}}" type="text" name="link" id="link">
                @error("link")
                <p>{{$message}}</p>
                @else
                <p></p>
                @enderror
            </div>
        </div>
        <div class="input @error("textare") error @enderror">
            <label for="synopsis">Description</label>
            <textarea name="synopsis" id="synopsis">{{$movie->synopsis}}</textarea>
            @error("textare")
            <p>Error me</p>
            @enderror
        </div>
        <div class="input_group">
            <div class="input @error("cover") error @enderror">
                <label for="cover">Cover</label>
                <input type="file" class="file_input" name="cover" id="cover">
                @error("cover")
                <p>{{$message}}</p>
                @else
                <p></p>
                @enderror
            </div>
            <div class="input @error("banner") error @enderror">
                <label for="banner">Banner</label>
                <input type="file" class="file_input" name="banner" id="banner">
                @error("banner")
                <p>{{$message}}</p>
                @else
                <p></p>
                @enderror
            </div>
        </div>
        <div id="form_buttons">
            <button type="reset" id="reset_button">Reset</button>
            <button type="submit" id="save_button">Save</button>
        </div>
    </form>
</main>
@endsection
@section('js')
    @vite(['resources/js/form.js'])
@endsection
