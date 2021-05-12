<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Song;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($genre = null)
    {
        // $songs = Song::paginate(15)->through(function ($song) {
        //     return [
        //         'id' => $song->id,
        //         'name' => $song->name,
        //         'artist' => $song->artist,
        //         'genre' => $song->genre,
        //         'duration' => $song->duration,
        //     ];
        // });
        $songs = Song::getAllSongs($genre);
        return Inertia::render('Song/Index', [
            'songs' => $songs,
            'genres' => Genre::all(),
            'currentGenre' => $genre,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function show(Song $song)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function edit(Song $song)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Song $song)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function destroy(Song $song)
    {
        //
    }
}
