<template>
    <app-layout>
        <template #header>
            <h1 class="font-weight-bold">Songs</h1>
        </template>
        <ul v-for="song in songs" :key="song" class="list-group">
            <a href="#" class="list-group-item list-group-item-action">
                {{ song.name }}
            </a>
        </ul>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
export default {
    components: {
        AppLayout,
    },
    props: {
        songs: Array,
    },
};
</script>

<style>
</style>