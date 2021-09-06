<?php

namespace App\Lib\Interfaces;

interface PlaylistInterface
{
    public function addSong($id);

    public function removeSong($id, $relationId);
}
