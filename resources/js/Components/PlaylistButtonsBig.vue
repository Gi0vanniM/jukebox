<template>
    <div class="col">
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
            <button
                v-for="playlist in $page.props.playlists"
                v-bind:key="playlist.id"
                type="button"
                class="btn dropdown-item"
            >
                {{ playlist.name }}
            </button>
        </div>
        <button type="button" class="pl-btn btn btn-primary m-1 btn-block">
            <h2 class="m-0">Add to session</h2>
        </button>
    </div>
</template>

<script>
export default {};
</script>

<style>
</style>