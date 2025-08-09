<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::with('category')->get(); // $movie->category->name para paegar a categoria
        return view('movie.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('movie.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request)
    {
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

        Movie::create($data);

        return redirect()->route('movie.index')->with('success', 'Filme criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        return view('movies.index', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        return view('movie.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('movies', 'public');

            $data['image'] = $imagePath;
        }

        $movie = Movie::find($movie->id);

        $movie->update($data);

        return redirect()->route('movie.index')->with('success', 'Filme alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        $movie = Movie::findOrFail($movie->id);

        $movie->delete();

        return redirect('movie.index')->with('success', 'Filme deletado com sucesso!');
    }

    public function filtered(Request $request)
    {
        $query = Movie::with('category');

        $filterApplied = false;
        
        if($request->filled('title')) {
            $query->where('title', 'LIKE', '%' . $request->input('title') . '%');
            $filterApplied = true;
        }
        
        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
            $filterApplied = true;
        }
        
        if ($request->filled('year')) {
            $query->where('year', $request->input('year'));
            $filterApplied = true;
        }

        if(!$filterApplied){
            return redirect()->route('movie.index')->with('warning', 'Nenhum filme encontrado com esse filtro, tente com outro...');
        }

        $movies = $query->get();

        return view('movie.filtered', compact('movies'));
    }

    // Não sei se faz sentido adicionar, pois todos são criados no mesmo momento...
    //public function recent_added(){}

    public function popular(){
        $query = Movie::with('category')->where('rating', '>=', 7);

        $movies = $query->get();

        dd($movies);
        return view('movie.pupular', compact('movies'));
    }
}
