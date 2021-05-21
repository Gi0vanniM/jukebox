<template>
    <app-layout v-bind:title="song.name">

        <template #header>
            <h1 class="font-weight-bold">
                {{ song.name }}
            </h1>
        </template>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
    components: {
        AppLayout,
    },
    props: {
        song: Array,
    },
};
</script>

<style>
</style>