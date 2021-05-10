<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Song extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'songs';

    protected $with = ['genre', 'artist'];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    /**
     * get all songs with an option to filter by genre
     *
     * @param [type] $genre
     * @param boolean $paginate
     * @return Song
     */
    public static function getAllSongs($genre = null, $paginate = true)
    {
        $collection = Song::when($genre, function ($query) use ($genre) {
            $query->whereHas('genre', function ($query) use ($genre) {
                $query->where('name', '=', $genre);
            });
        });

        $collection = ($paginate) ? $collection->paginate(15) : $collection->get();

        return $collection;
    }
}
