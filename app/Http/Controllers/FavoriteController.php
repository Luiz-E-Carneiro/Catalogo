<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $user = Auth::user();

        $favorites = $user->favorites()->with('category')->get();

        return view('favorites.index', compact('favorites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($movie_id) {
        if (Auth::check()) {
            if (Auth::user()->wish_list()->where("movie_id", $movie_id)->exists()) {
                $wish_movie = Favorite::where("movie_id", $movie_id)->where("user_id", Auth::user()->id)->first();
                $wish_movie->delete();
            } else {
                Favorite::create([
                    "user_id" => Auth::user()->id,
                    "movie_id" => $movie_id,
                ]);
            }
        }
        return 1;
    }

    /**
     * Display the specified resource.
     */
    public function show(Favorite $favorite) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favorite $favorite) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFavoriteRequest $request, Favorite $favorite) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Favorite $favorite) {
        $user = Auth::user();

        $user->favorites()->detach($favorite->id);

        return redirect()->back()->with('success', 'Filme removido dos favoritos com sucesso!');
    }
}
