<template>
    <app-layout
        v-bind:title="title"
    >
        <template #header>
            <h1 class="font-weight-bold">
                Songs{{ currentGenre ? " | " + currentGenre ?? "" : "" }}
            </h1>
        </template>

        <button
            class="btn btn-primary"
            data-target="#collapseGenres"
            data-toggle="collapse"
            role="button"
            aria-expanded="false"
            aria-controls="collapseGenres"
        >
            Genres
        </button>
        <div class="collapse" id="collapseGenres">
            <div class="card card-body">
                <ul class="list-group">
                    <inertia-link
                        :href="route('song.index')"
                        class="list-group-item list-group-item-action"
                    >
                        - all songs -
                    </inertia-link>
                    <inertia-link
                        v-for="genre in genres"
                        :key="genre"
                        :href="route('song.index', genre.name)"
                        class="list-group-item list-group-item-action"
                    >
                        {{ genre.name }}
                    </inertia-link>
                </ul>
            </div>
        </div>

        <table class="table table-hover border">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Artist</th>
                    <th scope="col"><i class="far fa-clock"></i></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="song in songs.data" :key="song.id">
                    <td>
                        <inertia-link
                            :href="route('song.show', [song.id, song.name])"
                        >
                            {{ song.name }}
                        </inertia-link>
                    </td>
                    <td>{{ song.artist.name }}</td>
                    <td>{{ secondsToTime(song.duration) }}</td>
                    <td><playlist-button class="float-right" /></td>
                </tr>
            </tbody>
        </table>

        <pagination :links="songs.links" />
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Pagination from "@/Components/Pagination";
import PlaylistButton from "@/Components/PlaylistButtonsSmall";
import { helperMixin } from "@/Mixins/HelperMixin.js";
export default {
    mixins: [helperMixin],
    components: {
        AppLayout,
        Pagination,
        PlaylistButton,
    },
    props: {
        songs: Array,
        genres: Array,
        currentGenre: String,
    },
    data() {
        return {
        }
    },
    computed: {
        title: function() {
            return 'Songs' + (this.currentGenre ? ' | ' + this.currentGenre ?? '' : '');
        }
    },
};
</script>

<style>
</style>