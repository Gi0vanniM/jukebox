<?php

namespace Database\Factories;

use App\Models\Song;
use Illuminate\Database\Eloquent\Factories\Factory;

class SongFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Song::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->realText(15, 3),
            'song_src' => '/public/songs/song.pm3',
            'duration' => rand(60, 400),
            'genre_id' => rand(1, 6),
            'artist_id' => rand(1, 10),
        ];
    }
}
