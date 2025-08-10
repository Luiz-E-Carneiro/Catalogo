<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Movie;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller {
    public function index() {
        $wish_list = [];
        if (Auth::check() && !empty(Auth::user()->wish_list)) {
            $wish_list = Auth::user()->wish_list()->limit(5)->get();
        }
        $week_start = Carbon::now()->startOfWeek();
        $week_end = Carbon::now()->endOfWeek();
        $popular_movies = Movie::query()
            ->select('movies.id', DB::raw('COUNT(favorites.id) as saves_count'))
            ->join('favorites', 'movies.id', '=', 'favorites.movie_id')
            ->whereBetween('favorites.created_at', [$week_start, $week_end])
            ->groupBy('movies.id')
            ->orderByDesc('saves_count')
            ->limit(6)->get()->toArray();
        $movies = [];
        foreach ($popular_movies as $movie) {
            $popular_movie = Movie::find($movie["id"]);
            $popular_movie["custom_rating"] = $popular_movie["rating"] * 5 / 10;
            $popular_movie["star_count"] = (int) $popular_movie["custom_rating"];
            $movies[] = $popular_movie;
        }
        return view("index", [
            "all_movies" => Movie::orderBy("created_at", "desc")->get(),
            "wish_list" => $wish_list,
            "popular_movies" => $movies,
        ]);
    }
}
