<?php

namespace App\Http\Controllers;

use App\Models\Movie;
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

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('movie.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request) {
        $data = $request->validated();

        if($request->hasFile('cover')){
            $image = $request->file('cover');
            $imagePath = $image->store('movies', 'public');
    
            $data['cover'] = $imagePath;
        }
        if($request->hasFile('banner')){
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
    public function show(Movie $movie) {
        return view('movies.index', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie) {
        return view('movie.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieRequest $request, Movie $movie) {
        $data = $request->validated();

        if($request->hasFile('image')){
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
    public function destroy(Movie $movie) {
        $movie = Movie::findOrFail($movie->id);

        $movie->delete();

        return redirect('movie.index')->with('success', 'Filme deletado com sucesso!');
    }
}
