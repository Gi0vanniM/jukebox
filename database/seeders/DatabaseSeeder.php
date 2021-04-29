<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\Playlist;
use App\Models\PlaylistSong;
use App\Models\Song;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(GenreSeeder::class);

        User::factory(10)->create();

        Artist::factory(10)->create();

        // artists and genres must be generated before songs
        Song::factory(10)->create();

        // users must be generated before playlists
        Playlist::factory(10)->create();

        // playlists must be generated before playlist_songs
        // TODO: make playlist_song seeder
    }
}
