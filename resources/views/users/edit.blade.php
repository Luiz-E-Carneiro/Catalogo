@extends('layouts.default_page')
@section('head')
    @vite(['resources/css/form.css'])
@endsection
@section('content')
<main>
    <section id="page_title">
        <h1>Edit @if ($user->id == Auth::user()->id) your @else the @endif profile</h1>
        <p>Update the fields to edit @if ($user->id == Auth::user()->id) your @else this @endif profile</p>
    </section>
    <form action="{{route("user.update")}}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <input type="hidden" name="id" value="{{$user->id}}">
        <div class="input_group">
            <div class="input @error("name") error @enderror">
                <label for="name">Title</label>
                <input value="{{$user->name}}" type="text" name="name" id="name">
                @error("name")
                <p>{{$message}}</p>
                @else
                <p></p>
                @enderror
            </div>
            <div class="input @error("email") error @enderror">
                <label for="email">Publisher</label>
                <input value="{{$user->email}}" type="email" name="email" id="email">
                @error("email")
                <p>{{$message}}</p>
                @else
                <p></p>
                @enderror
            </div>
        </div>
        <div class="input @error("password") error @enderror">
            <label for="password">Current Password</label>
            <input type="password" name="password" id="password">
            @error("password")
            <p>{{$message}}</p>
            @else
            <p></p>
            @enderror
        </div>
        <div class="input @error("new_password") error @enderror">
            <label for="new_password">New Password (if You want)</label>
            <input type="password" name="new_password" id="new_password">
            @error("new_password")
            <p>{{$message}}</p>
            @else
            <p></p>
            @enderror
        </div>
        <div class="input @error("password_confirmation") error @enderror">
            <label for="password_confirmation">Confirm new Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation">
            @error("password_confirmation")
            <p>{{$message}}</p>
            @else
            <p></p>
            @enderror
        </div>
        <div class="input @error("profile") error @enderror">
            <label for="profile">Profile</label>
            <input type="file" class="file_input" name="profile" id="profile">
            @error("profile")
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
