<template>
    <app-layout>
        <template #header>
            <div class="row">
                <div class="col">
                    <small class="font-weight-bold">PLAYLIST</small>
                    <h2 class="h2 font-weight-bold">Your session playlist</h2>
                    <small
                        ><b>{{ playlist.user.name }}</b> •
                        {{ playlist.songs.length }} songs,
                        {{ totalTime }}</small
                    >
                </div>
                <div class="col">
                    <div class="float-right">
                        <div class="btn-group">
                            <button
                                v-on:click="saveSession(playlist)"
                                type="button"
                                class="btn btn-secondary btn-small px-1"
                            >
                                Save session as playlist
                            </button>
                        </div>
                    </div>
                </div>
            </div>
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
                <tr
                    v-for="(song, index) in playlist.songs"
                    :key="index"
                    :id="'playlist_song-' + song.relationId"
                >
                    <td>
                        <inertia-link
                            :href="route('song.show', [song.id, song.name])"
                        >
                            {{ song.name }}
                        </inertia-link>
                    </td>
                    <td>{{ song.artist.name }}</td>
                    <td>{{ secondsToTime(song.duration) }}</td>
                    <td>
                        <playlist-button
                            :currentPlaylist="playlist"
                            :song="song"
                            :relationId="song.relationId"
                            class="float-right"
                        ></playlist-button>
                    </td>
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
        };
    },
    computed: {
        totalTime: function () {
            return this.secondsToTime(
                this.playlist.songs.reduce((a, b) => a + b.duration, 0)
            );
        },
    },
    methods: {
        saveSession(playlist) {
            this.$swal
                .fire({
                    title: `Save session as playlist?`,
                    icon: "question",
                    input: "text",
                    inputPlaceholder: "enter a name for the playlist",
                    showCancelButton: true,
                    confirmButtonColor: "#00FF00",
                    confirmButtonText: "Save session",
                    showLoaderOnConfirm: true,
                    preConfirm: (name) => {
                        return axios
                            .post("/api/saveSession", { name: name })
                            .then((response) => {
                                console.log(response);
                                if (response.data.error) {
                                    this.$swal.showValidationMessage(
                                        `Request failed: ${response.data.error}`
                                    );
                                } else if (response.data.alreadyExists) {
                                    this.$swal.showValidationMessage(
                                        `A playlist by the name of "${response.data.name}" already exists!`
                                    );
                                }
                                return response.data;
                            });
                    },
                    allowOutsideClick: () => !this.$swal.isLoading(),
                })
                .then((result) => {
                    if (result.value && result.value.sessionSaved) {
                        this.$swal.fire({
                            toast: true,
                            timer: 2000,
                            timerProgressBar: true,
                            title: `Session saved as "${result.value.name}"`,
                        });
                        return this.$inertia.visit(`/playlists/${result.value.id}/${result.value.name}`);
                    }
                });
        },
    },
};
</script>

<style>
</style>