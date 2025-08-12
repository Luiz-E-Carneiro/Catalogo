<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;

class MovieController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $movies = Movie::orderBy("created_at", "desc");
        return view('movie.index', []);
    }
    public function search(Request $request) {
        $movies = Movie::query();
        $search_text = [
            "title",
            "synopsis",
            "publisher",
        ];
        $search_term = "%".$request["text"]."%";
        if ($request["search_text"] != 0) {
            $movies->whereRaw("LOWER(".$search_text[$request["search_text"]-1].") like ?", $search_term);
        } else {
            $movies->where(function ($query) use ($search_text, $search_term) {
                foreach ($search_text as $field) {
                    $query->orWhereRaw("LOWER(".$field.") like ?", [$search_term]);
                }
            });
        }
        if ($request["category"] != 0) {
            $movies->where("category_id", $request["category"]);
        }
        if ($request["order_by"] != 0) {
            $order_option = $request["order_by"];
            if ($order_option == 1) {
                $movies->orderByDesc("year");
            } else if ($order_option == 2) {
                $movies->orderByDesc("rating");
            } else {
                $movies->select('movies.*', DB::raw('COUNT(favorites.id) as wishlist_count'))
                    ->leftJoin('favorites', 'movies.id', '=', 'favorites.movie_id')
                    ->groupBy([
                        "movies.id",
                        "movies.title",
                        "movies.synopsis",
                        "movies.publisher",
                        "movies.year",
                        "movies.rating",
                        "movies.link",
                        "movies.cover",
                        "movies.banner",
                        "movies.category_id",
                        "movies.created_at",
                        "movies.updated_at",
                    ])
                    ->orderByDesc('wishlist_count');
            }
        }
        $movies = $movies->get();
        return view("search", [
            "movies" => $movies,
            "text" => $request["text"],
            "filter" => [$request["search_text"], $request["category"], $request["order_by"]],
            "categories" => Category::all()->toArray(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('movies.insert', [
            "categories" => Category::all()->toArray(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request) {
        $data = $request->validated();

        if ($request->hasFile('cover')) {
            $image = $request->file('cover');
            $imagePath = $image->store('movies', 'public');

            $data['cover'] = $imagePath;
        }
        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $imagePath = $image->store('movies', 'public');

            $data['banner'] = $imagePath;
        }
        $movie = Movie::create($data);
        
        return redirect()->route('movie.show', $movie->id)->with('success', 'Filme criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie) {
        $wish_list = [];
        if (Auth::check() && !empty(Auth::user()->wish_list)) {
            $wish_list = Auth::user()->wish_list()->limit(5)->get();
        }
        $movie["custom_rating"] = $movie["rating"] * 5 / 10;
        $movie["star_count"] = (int) $movie["custom_rating"];
        return view('movies.index', [
            "movie" => $movie,
            "related_movies" => Movie::where("category_id", $movie->category_id)->where("id", "!=", $movie->id)->limit(10)->get(),
            "wish_list" => $wish_list,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie) {
        return view('movies.edit', [
            "categories" => Category::all()->toArray(),
            "movie" => $movie,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieRequest $request) {
        $data = $request->validated();
        $movie = Movie::find($request["id"]);

        if ($request->hasFile('cover')) {
            $image = $request->file('cover');
            $imagePath = $image->store('movies', 'public');
            $data['cover'] = $imagePath;
        } else {
            $data['cover'] = $movie->cover;
        }
        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $imagePath = $image->store('movies', 'public');
            $data['banner'] = $imagePath;
        } else {
            $data['banner'] = $movie->banner;
        }
        $movie->update($data);

        return redirect()->route('movie.show', $movie->id)->with('success', 'Filme alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie) {
        $movie->delete();
        return redirect()->route("index")->with('success', 'Filme deletado com sucesso!');
    }
    public function popular(){
        $query = Movie::with('category')->where('rating', '>=', 7);

        $movies = $query->get();
        return view('movie.popular', compact('movies'));
    }
}
