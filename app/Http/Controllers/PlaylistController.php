<?php

namespace App\Http\Controllers;

use App\Lib\PlaylistSaved;
use App\Lib\PlaylistSession;
use App\Models\Playlist;
use App\Models\User;
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
        if (!isset($request->name)) {
            return response()->json(
                ['error' => 'no name given']
            );
        }

        if (Playlist::where('name', '=', $request->name)->exists()) {
            return response()->json(
                [
                    'name' => $request->name,
                    'alreadyExists' => true
                ]
            );
        }

        $playlist = new Playlist();
        $playlist->name = $request->name;

        $user = User::find(Auth::id());
        if (!$user->playlists()->save($playlist)) {
            return response()->json(
                [
                    'error' => 'something went wrong',
                ]
            );
        }

        return response()->json(
            [
                'name' => $request->name,
                'playlist' => $playlist,
                'playlistCreated' => true,
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Playlist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function show(Playlist $playlist)
    {
        $playlistSaved = new PlaylistSaved($playlist->id);
        return Inertia::render('Playlist/Show', [
            'playlist' => $playlistSaved->getPlaylist(),
            'playlists' => Playlist::where('user_id', Auth::id())->get(),
        ]);
    }

    public function session(Request $request)
    {
        $playlistSession = new PlaylistSession();
        return Inertia::render('Playlist/Session', [
            'playlist' => $playlistSession->getPlaylist(),
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
        if (!isset($request->newName)) {
            return response()->json(
                ['error' => 'no name given']
            );
        }

        if (Playlist::where('name', '=', $request->newName)->exists()) {
            return response()->json(
                [
                    'name' => $request->newName,
                    'alreadyExists' => true
                ]
            );
        }

        $user = User::find(Auth::id());
        if ($playlist->user_id != $user->id && !$user->hasRole('Administrator')) {
            return response()->json(
                [
                    'error' => 'you cannot change other`s playlist',
                ]
            );
        }

        $playlist->name = $request->newName;

        if (!$playlist->save()) {
            return response()->json(
                [
                    'error' => 'something went wrong',
                ]
            );
        }

        return response()->json(
            [
                'name' => $playlist->name,
                'playlist' => $playlist,
                'playlistUpdated' => true,
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Playlist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Playlist $playlist)
    {
        if (!$playlist->delete()) {
            return response()->json(
                [
                    'playlist' => $playlist,
                    'error' => 'something went wrong',
                ]
            );
        }

        return response()->json(
            [
                'playlistDeleted' => true,
            ]
        );
    }

    /**
     * add a song to playlist
     *
     * @param Request $request
     * @return json
     */
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

    /**
     * remove a song from playlist
     *
     * @param Request $request
     * @return json
     */
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
