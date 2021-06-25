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
                    <playlist-button :song="song" :small="false"/>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import BackButton from "@/Components/BackButton";
import PlaylistButton from "@/Components/PlaylistButtons";
import { helperMixin } from "@/Mixins/HelperMixin";
export default {
    mixins: [helperMixin],
    components: {
        AppLayout,
        BackButton,
        PlaylistButton,
    },
    props: {
        song: Object,
    },
};
</script>

<style>
</style>