<?php

namespace App\Lib;

use App\Lib\Interfaces\PlaylistInterface;
use App\Models\Song;
use stdClass;

class PlaylistSession implements PlaylistInterface
{
    private $playlist;

    function __construct()
    {
        if (session('playlist') !== null) {
            $this->playlist = session('playlist');
        } else {
            // set session data
            $this->playlist = new stdClass;
            $this->playlist->name = 'Session playlist';
            $this->playlist->user = auth()->user();
            $this->playlist->songs = [];
            session(['playlist' => $this->playlist]);
        }
    }

    public function getPlaylist()
    {
        return $this->playlist;
    }

    public function addSong($id, $forced = false)
    {
        // get the song by id
        $song = Song::find($id);

        // check if song is already in playlist
        $songExists = false;
        foreach ($this->playlist->songs as $pSong) {
            if ($pSong->id == $song->id) {
                $songExists = true;
                break;
            }
        }

        // if the song is in playlist
        // and if the client didn't click 'add anyway' ($forced)
        // tell the client, the client will see a menu asking to add the song anyway or cancel.
        if ($songExists && $forced == false) {
            return ['songExists' => true];
        }

        // insert/save the song in the relation table
        if ($status = ($this->playlist->songs[] = $song)) {
            // update session
            session(['playlist' => $this->playlist]);
            return ['addedSong' => true] + ($forced ? ['forced' => $forced] : []);
        }

        return $status;
    }

    public function removeSong($id, $relationId)
    {
        //
    }
}
