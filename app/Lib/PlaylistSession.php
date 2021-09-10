<?php

namespace App\Lib;

use App\Lib\Interfaces\PlaylistInterface;

class PlaylistSession implements PlaylistInterface
{
    public $playlist;

    function __construct()
    {
        if (session('playlist') !== null) {
            $this->playlist = session('playlist');
        } else {
            $this->playlist = [
                'name' => 'Session playlist',
                'user' => auth()->user(),
                'songs' => [],
            ];
        }
    }

    public function addSong($id)
    {
        //
    }

    public function removeSong($id, $relationId)
    {
        //
    }
}
