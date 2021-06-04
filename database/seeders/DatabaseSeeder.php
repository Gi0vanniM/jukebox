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

        $users = User::factory(10)->create();

        $artists = Artist::factory(10)->create();

        // artists and genres must be generated before songs
        $songs = Song::factory(100)->create();

        // users must be generated before playlists. 
        // playlist_song entries are created with the hasAttached method.
        $playlists = Playlist::factory(10)->hasAttached($songs)->create();
    }
}
