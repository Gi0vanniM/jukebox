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
            <template
                v-for="playlist in $page.props.playlists"
                v-bind:key="playlist.id"
            >
                <button
                    v-on:click="addToPlaylist(playlist.id, song.id)"
                    type="button"
                    class="btn dropdown-item"
                >
                    {{ playlist.name }}
                </button>
                <already-added-alert
                    :songId="song.id"
                    :playlistId="playlist.id"
                    :playlistName="playlist.name"
                />
            </template>
        </div>
        <button
            v-on:click="addToPlaylist(null, song.id)"
            type="button"
            class="btn btn-primary btn-small px-1"
        >
            Add to session
        </button>
        <already-added-alert
            :songId="song.id"
            :playlistId="'session'"
            :playlistName="null"
        />
    </div>
</template>

<script>
import AlreadyAddedAlert from "@/Components/AlreadyAddedAlert";
export default {
    props: {
        song: Object,
    },
    components: {
        AlreadyAddedAlert,
    },
    methods: {
        addToPlaylist: function (playlistId = null, songId, forced = false) {
            const data = {
                playlistId: playlistId || null,
                songId: songId,
                forced: forced,
            };
            axios.post("/api/addSongToPlaylist", data).then((response) => {
                console.log(response.data); //##
                if (response.data.songExists == true) {
                    $("#addSongAnyway-" + songId + "-" + playlistId).modal(
                        "show"
                    );
                }
            });
        },
    },
};
</script>

<style>
</style>