<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller {
    public function index() {
        $wish_list = [];
        if (Auth::check() && !empty(Auth::user()->wish_list)) {
            $wish_list = Auth::user()->wish_list;
        }
        $week_start = Carbon::now()->startOfWeek();
        $week_end = Carbon::now()->endOfWeek();
        $first_movie = Movie::query()
            ->select('movies.id', DB::raw('COUNT(favorites.id) as saves_count'))
            ->join('favorites', 'movies.id', '=', 'favorites.movie_id')
            ->whereBetween('favorites.created_at', [$week_start, $week_end])
            ->groupBy('movies.id')
            ->orderByDesc('saves_count')
            ->first()->toArray()["id"];
        return view("index", [
            "all_movies" => Movie::orderBy("created_at", "desc"),
            "wish_list" => $wish_list,
            "first_movie" => Movie::find($first_movie),
        ]);
    }
}
