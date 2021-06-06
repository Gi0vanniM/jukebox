<template>
    <app-layout v-bind:title="song.name">
        <template #header>
            <back-button />
        </template>

        <div class="card border">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h1 class="font-weight-bold">
                            {{ song.name }}
                        </h1>
                        <h2>
                            by {{ song.artist.name }} <br />
                            {{ song.genre.name }}
                            {{ secondsToTime(song.duration) }}
                        </h2>
                    </div>
                    <div class="col">
                        <button
                            type="button"
                            class="pl-btn btn btn-secondary m-1 btn-block"
                        >
                            <h2 class="m-0">Add to playlist</h2>
                        </button>
                        <button
                            type="button"
                            class="pl-btn btn btn-primary m-1 btn-block"
                        >
                            <h2 class="m-0">Add to session</h2>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import BackButton from "@/Components/BackButton";
import { helperMixin } from "@/Mixins/HelperMixin";
export default {
    mixins: [helperMixin],
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
    .pl-btn {
        border-radius: 1em;
    }
</style>