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
            $this->resetSession();
        }
    }

    public function resetSession()
    {
        $this->playlist = new stdClass;
        $this->playlist->name = 'Session playlist';
        $this->playlist->songs = array();
        session(['playlist' => $this->playlist]);
    }

    public function getPlaylist()
    {
        return $this->playlist;
    }

    public function addSong($id, $forced = false)
    {
        // get the song by id
        // $song = Song::find($id);
        $song = new stdClass();
        $song->id = $id;

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

        // get the latest relationId
        $relationId = 0;
        foreach ($this->playlist->songs as $pSong) {
            if ($pSong->relationId > $relationId) {
                $relationId = $pSong->relationId;
            }
        }
        // make new relation id
        $relationId++;

        $song->relationId = $relationId;

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
        // check if song is in playlist
        $songExists = false;
        foreach ($this->playlist->songs as $pSong) {
            if ($pSong->id == $id) {
                $songExists = true;
                break;
            }
        }

        if (!$songExists) {
            return ['songNotInPlaylist' => true];
        }

        // find the song by relation id
        $songIndex = array_search($relationId, array_column($this->playlist->songs, 'relationId'));

        // remove song from playlist
        if ($status = array_splice($this->playlist->songs, $songIndex, 1)) {
            session(['playlist' => $this->playlist]);
            return ['removedSong' => true];
        }


        return $status;
    }
}
