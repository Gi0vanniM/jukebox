<template>
    <div class="btn-group">
        <button
            type="button"
            class="btn btn-secondary btn-small px-1 dropdown-toggle"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
        >
            Add to playlist
        </button>
        <div class="dropdown-menu">
            <button
                v-for="playlist in $page.props.playlists"
                v-bind:key="playlist.id"
                v-on:click="addToPlaylist(playlist, song)"
                type="button"
                class="btn dropdown-item"
            >
                {{ playlist.name }}
            </button>
        </div>
        <button 
            v-on:click="addToPlaylist(null, song)"
            type="button" 
            class="btn btn-primary btn-small px-1">
            Add to session
        </button>
    </div>
</template>

<script>
export default {
    props: {
        song: Object,
    },
    methods: {
        addToPlaylist: function (playlist, song, force = false) {
            const data = {
                playlistId: (playlist) ? playlist.id : null,
                songId: song.id,
                force: force,
            };
            axios.post("/api/addSongToPlaylist", data).then((response) => {
                console.log(response.data);
                if (response.data.songExists == true) {
                    alert('song already in playlist');
                }
            });
        },
    },
};
</script>

<style>
</style>