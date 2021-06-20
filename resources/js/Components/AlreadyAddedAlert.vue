<template>
    <teleport to="#modals">
        <div
            class="modal fade"
            :id="modalId"
            tabindex="-1"
            role="dialog"
            :aria-labelledby="'#' + modalId + '.Label'"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <h4
                            class="modal-title font-weight-bold"
                            :id="'#' + modalId + '.Label'"
                        >
                            Already added
                        </h4>

                        <template v-if="playlistName || playlistId !== 'session'">
                            This is already in your '{{ playlistName }}' playlist.
                        </template>
                        <template v-else>
                            This is already in your session.
                        </template>

                        <div class="d-flex justify-content-center pt-3">
                            <button
                                type="button"
                                class="btn"
                                v-on:click="$parent.addToPlaylist(playlistId, songId, true)"
                                data-dismiss="modal"
                            >
                                ADD ANYWAY
                            </button>
                            <button
                                type="button"
                                class="btn btn-primary"
                                data-dismiss="modal"
                            >
                                DON'T ADD
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </teleport>
</template>

<script>
export default {
    props: {
        songId: {
            type: Number,
            required: true,
        },
        playlistId: {},
        playlistName: String,
    },
    data() {
        return {
            modalId: "addSongAnyway-" + this.songId + "-" + this.playlistId,
        };
    },
};
</script>

<style scoped>
.modal-content {
    border-radius: 1rem;
}
</style>