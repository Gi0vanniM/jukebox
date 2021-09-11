<template>
    <!-- small buttons -->
    <div class="btn-group" v-if="small">
        <button
            type="button"
            class="btn btn-secondary btn-small px-1"
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
            :playlistId="null"
            :playlistName="null"
        />

        <button
            v-if="currentPlaylist"
            v-on:click="
                removeFromPlaylist(
                    currentPlaylist.id,
                    song.id,
                    relationId ?? song.pivot.id
                )
            "
            type="button"
            class="btn btn-danger btn-small px-1"
        >
            Remove from playlist
        </button>

        <added-alert v-if="!exists('addedToPlaylist')" />
    </div>
    <!-- big buttons -->
    <div class="col" v-else>
        <button
            type="button"
            class="pl-btn btn btn-secondary m-1 btn-block dropdown-toggle"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
        >
            <h2 class="m-0">Add to playlist</h2>
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
            class="pl-btn btn btn-primary m-1 btn-block"
        >
            <h2 class="m-0">Add to session</h2>
        </button>
        <already-added-alert
            :songId="song.id"
            :playlistId="null"
            :playlistName="playlist.name"
        />
        <added-alert v-if="!exists('addedToPlaylist')" />
    </div>
</template>

<script>
import AlreadyAddedAlert from "@/Components/AlreadyAddedAlert";
import AddedAlert from "@/Components/AddedAlert";
import { helperMixin } from "@/Mixins/HelperMixin.js";
export default {
    mixins: [helperMixin],
    props: {
        small: {
            default: true,
            type: Boolean,
        },
        song: Object,
        relationId: {
            default: null,
        },
        currentPlaylist: {
            default: null,
            type: Object,
        },
    },
    components: {
        AlreadyAddedAlert,
        AddedAlert,
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
                if (response.data.addedSong == true) {
                    $("#addedToPlaylist").toast("show");
                }
            });
        },
        removeFromPlaylist: function (playlistId, songId, relationId) {
            const data = {
                playlistId: playlistId,
                songId: songId,
                relationId: relationId,
            };
            axios.post("/api/removeSongFromPlaylist", data).then((response) => {
                console.log(response.data); //##
                if (response.data.removedSong == true) {
                    let el = document.getElementById("playlist_song-" + relationId);
                    el.remove();
                    this.$swal("Removed song from playlist");

                    // this.currentPlaylist.songs.forEach((song, index) => {
                    //     if (this.relationId !== null && index === relationId) {
                    //         delete this.currentPlaylist.songs[index];
                    //         return;
                    //     }
                    // });
                }
            });
        },
    },
};
</script>

<style>
</style>