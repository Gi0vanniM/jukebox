<template>
    <app-layout>
        <template #header>
            <h1 class="font-weight-bold">Songs{{ " | " + currentGenre ?? "" }}</h1>
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
                <ul v-for="genre in genres" :key="genre" class="list-group">
                    <inertia-link
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
                </tr>
            </thead>
            <tbody>
                <tr v-for="song in songs.data" :key="song.id">
                    <td>{{ song.name }}</td>
                    <td>{{ song.artist.name }}</td>
                    <td>{{ secondsToTime(song.duration) }}</td>
                </tr>
            </tbody>
        </table>

        <pagination :links="songs.links" />
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Pagination from "@/Components/Pagination";
export default {
    components: {
        AppLayout,
        Pagination,
    },
    props: {
        songs: Array,
        genres: Array,
        currentGenre: String,
    },
    methods: {
        secondsToTime(seconds) {
            return new Date(seconds * 1000)
                .toISOString()
                .substr(11, 8)
                .replace(/^0(?:0:0?)?/, "");
        },
    },
};
</script>

<style>
</style>