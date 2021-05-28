<template>
    <app-layout v-bind:title="song.name">

        <template #header>
            <back-button/>
            <h1 class="font-weight-bold">
                {{ song.name }}
            </h1>
        </template>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import BackButton from "@/Components/BackButton";

export default {
    components: {
        AppLayout,
        BackButton,
    },
    props: {
        song: Array,
    },
};
</script>

<style>
</style>