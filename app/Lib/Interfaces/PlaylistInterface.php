<?php

namespace App\Lib\Interfaces;

interface PlaylistInterface
{
    public function addSong($id, $forced = false);

    public function removeSong($id, $relationId);
}
