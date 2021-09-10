<?php

namespace App\Http\Controllers;

use App\Lib\PlaylistSaved;
use App\Lib\PlaylistSession;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Playlist/Index', [
            'playlists' => Playlist::where('user_id', Auth::id())->get(),
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
     * @param  \App\Models\Playlist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function show(Playlist $playlist)
    {
        return Inertia::render('Playlist/Show', [
            'playlist' => $playlist,
            'playlists' => Playlist::where('user_id', Auth::id())->get(),
        ]);
    }

    public function session(Request $request)
    {
        $playlistSession = new PlaylistSession();
        return Inertia::render('Playlist/Session', [
            'playlist' => $playlistSession->playlist,
            'playlists' => Playlist::where('user_id', Auth::id())->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Playlist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function edit(Playlist $playlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Playlist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Playlist $playlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Playlist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Playlist $playlist)
    {
        //
    }

    public function add(Request $request)
    {
        // playlistId
        // songId

        $playlist = null;
        $response = null;

        // check if playlist id is present
        // if not present the song needs to be saved in session
        if ($request->playlistId) {
            $playlist = new PlaylistSaved($request->playlistId);
        } else {
            $playlist = new PlaylistSession();
        }

        $response = $playlist->addSong($request->songId, $request->forced);

        return response()->json(
            $response
        );
    }

    public function remove(Request $request)
    {
        // playlistId
        // songId

        $playlist = null;
        $response = null;

        // check if playlist id is present
        // if not present get the session playlist
        if ($request->playlistId) {
            $playlist = new PlaylistSaved($request->playlistId);
        } else {
            $playlist = new PlaylistSession();
        }

        $response = $playlist->removeSong($request->songId, $request->relationId);

        return response()->json(
            $response
        );
    }
}
