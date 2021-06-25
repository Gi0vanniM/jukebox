<?php

namespace App\Lib;

use App\Lib\Interfaces\PlaylistInterface;
use App\Models\Playlist;
use App\Models\Song;

class PlaylistSaved implements PlaylistInterface
{
    public $playlist;

    function __construct($playlistId)
    {
        $this->playlist = Playlist::find($playlistId);
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

    public function removeSong($id)
    {
        //
    }
}
