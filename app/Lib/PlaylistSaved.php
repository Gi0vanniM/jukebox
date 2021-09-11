<?php

namespace App\Lib;

use App\Lib\Interfaces\PlaylistInterface;
use App\Models\Playlist;
use App\Models\Song;

class PlaylistSaved implements PlaylistInterface
{
    private $playlist;

    function __construct($playlistId)
    {
        $this->playlist = Playlist::find($playlistId);
    }

    public function getPlaylist()
    {
        return $this->playlist;
    }

    /**
     * add song method
     *
     * @param [type] $id
     * @param boolean $forced
     * @return void
     */
    public function addSong($id, $forced = false)
    {
        // get the song by id
        $song = Song::find($id);

        if ($this->playlist->songs->contains($song->id) && $forced == false) {
            return ['songExists' => true];
        }

        // insert/save the song in the relation table
        if ($status = $this->playlist->songs()->save($song)) {
            return ['addedSong' => true] + ($forced ? ['forced' => $forced] : []);
        }

        return $status;
    }

    /**
     * remove song method
     *
     * @param [type] $id
     * @return void
     */
    public function removeSong($id, $relationId)
    {

        if (!$this->playlist->songs->contains($id)) {
            return ['songNotInPlaylist' => true];
        }

        // remove song from playlist
        if ($status = $this->playlist->songs()->wherePivot('id', $relationId)->detach()) {
            return ['removedSong' => true];
        }

        return $status;
    }
}
