<template>
    <app-layout>
        <template #header>
            <small class="font-weight-bold">PLAYLIST</small>
            <h2 class="h2 font-weight-bold">Your session playlist</h2>
            <small><b>{{ playlist.user.name }}</b> • {{ playlist.songs.length }} songs, {{totalTime}}</small>
        </template>
        <table class="table table-hover border">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Artist</th>
                    <th scope="col"><i class="far fa-clock"></i></th>
                    <th scope="col"><i class="far fa-edit float-right"></i></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(song, index) in playlist.songs" :key="index" :id="'playlist_song-' + song.relationId">
                    <td>
                        <inertia-link
                            :href="route('song.show', [song.id, song.name])"
                        >
                            {{ song.name }}
                        </inertia-link>
                    </td>
                    <td>{{ song.artist.name }}</td>
                    <td>{{ secondsToTime(song.duration) }}</td>
                    <td><playlist-button :currentPlaylist="playlist" :song="song" :relationId="song.relationId" class="float-right"></playlist-button></td>
                </tr>
            </tbody>
        </table>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import PlaylistButton from "@/Components/PlaylistButtons";
import { helperMixin } from "@/Mixins/HelperMixin.js";
export default {
    mixins: [helperMixin],
    props: {
        playlist: Object,
    },
    components: {
        AppLayout,
        PlaylistButton,
    },
    data() {
        return {
            //
        }
    },
    computed: {
        totalTime: function() {
            return this.secondsToTime(this.playlist.songs.reduce((a, b) => a + b.duration, 0));
        }
    }
};
</script>

<style>

</style>