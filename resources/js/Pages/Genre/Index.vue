<template>
    <app-layout>
        <template #header>
            <h1 class="font-weight-bold">Genres</h1>
        </template>
        <ul v-for="genre in genres" :key="genre" class="list-group">
            <a href="#" class="list-group-item list-group-item-action">
                {{ genre.name }}
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
        genres: Array,
    },
};
</script>

<style>
</style>