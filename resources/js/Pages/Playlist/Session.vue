<template>
    <app-layout>
        <template #header>
            <small class="font-weight-bold">PLAYLIST</small>
            <h2 class="h2 font-weight-bold">Your session playlist</h2>
            <small><b>{{ playlist.user.name }}</b> • {{ playlist.songs.length }} songs, {{totalTime}}</small>
        </template>
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
        }
    },
    computed: {
        totalTime: function() {
            return this.secondsToTime(this.playlist.songs.reduce((a, b) => a + b.duration, 0));
        }
    }
};
</script>

<style>

</style>