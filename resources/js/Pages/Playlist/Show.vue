<template>
    <app-layout>
        <template #header>
            <div class="row">
                <div class="col">
                    <small class="font-weight-bold">PLAYLIST</small>
                    <h2 class="h2 font-weight-bold">{{ playlist.name }}</h2>
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
                                v-on:click="updatePlaylistName(playlist)"
                                type="button"
                                class="btn btn-secondary btn-small px-1"
                            >
                                Edit name
                            </button>
                            <button
                                v-on:click="deletePlaylist(playlist)"
                                type="button"
                                class="btn btn-danger"
                            >
                                <i class="fas fa-trash-alt"></i>
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
                    v-for="song in playlist.songs"
                    :key="song.pivot.id"
                    :id="'playlist_song-' + song.pivot.id"
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
        updatePlaylistName(playlist) {
            this.$swal
                .fire({
                    title: `Edit "${playlist.name}" playlist name?`,
                    icon: "question",
                    input: "text",
                    showCancelButton: true,
                    confirmButtonColor: "#00FF00",
                    confirmButtonText: "Edit name",
                    showLoaderOnConfirm: true,
                    preConfirm: (name) => {
                        return axios
                            .post("/api/updatePlaylist/" + playlist.id, {
                                newName: name,
                            })
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
                    if (result.value && result.value.playlistUpdated) {
                        this.$swal.fire({
                            toast: true,
                            timer: 2000,
                            timerProgressBar: true,
                            title: `Playlist renamed to "${result.value.name}"`,
                        });
                        this.playlist.name = result.value.name;
                    }
                });
        },
        deletePlaylist(playlist) {
            this.$swal
                .fire({
                    title: `Delete "${playlist.name}" playlist?`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    confirmButtonText: "Delete",
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return axios
                            .post("/api/deletePlaylist/" + playlist.id)
                            .then((response) => {
                                console.log(response);
                                if (response.data.error) {
                                    this.$swal.showValidationMessage(
                                        `Request failed: ${response.data.error}`
                                    );
                                }
                                return response.data;
                            });
                    },
                })
                .then((result) => {
                    if (result.value && result.value.playlistDeleted) {
                        this.$swal.fire({
                            toast: true,
                            timer: 2000,
                            timerProgressBar: true,
                            title: "Deleted!",
                            icon: "success",
                        });
                        return this.$inertia.visit("/playlists");
                    }
                });
        },
    },
};
</script>

<style>
</style>