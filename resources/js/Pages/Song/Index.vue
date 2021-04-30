<template>
    <app-layout>
        <template #header>
            <h1 class="font-weight-bold">Songs</h1>
        </template>
        <ul class="list-group">
            <a
                v-for="song in songs.data"
                :key="song.id"
                href="#"
                class="list-group-item list-group-item-action"
            >
                {{ song.name + " - " + song.artist.name }}
            </a>
        </ul>

    <pagination :links="songs.links"/>

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
    },
};
</script>

<style>
</style>