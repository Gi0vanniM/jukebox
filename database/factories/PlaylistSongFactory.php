<?php

namespace Database\Factories;

use App\Models\PlaylistSong;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlaylistSongFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PlaylistSong::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'playlist_id' => rand(1, 10),
            'song_id' => rand(1, 10),
        ];
    }
}
