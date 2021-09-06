<template>
    
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