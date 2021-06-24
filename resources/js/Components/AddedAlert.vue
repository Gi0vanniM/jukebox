<template>
    <div
        class="position-fixed bottom-0 right-0 p-3"
        style="z-index: 5; right: 50%; bottom: 1em"
    >
        <div
            id="addedToPlaylist"
            class="toast hide border-0 rounded-1rem bg-transparent"
            role="alert"
            aria-live="assertive"
            aria-atomic="true"
            data-delay="2000"
        >
            <div class="toast-body bg-primary text-white rounded-1rem px-4">
                Added to playlist
            </div>
        </div>
    </div>
</template>

<script>
export default {};
</script>

<style>
</style>