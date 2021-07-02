<template>
    <app-layout :title="'Your Playlists'">
        <template #header>
            <h2 class="h4 font-weight-bold">Your Playlists</h2>
        </template>

        <div class="row">
            <div class="col-12 col-sm-6 col-md-4 pt-2" v-for="playlist in playlists" :key="playlist.id">
                <inertia-link
                    :href="route('playlist.show', [playlist.id, playlist.name])"
                    class="card card-link h-100 bg-dark pb-1"
                >
                    <div class="card-body">
                        <h4 class="card-title">{{ playlist.name }}</h4>
                        <p class="card-text">
                            {{ recentSongs(playlist) || '...' }}
                        </p>
                    </div>
                </inertia-link>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
export default {
    props: {
        playlists: Object,
        genres: Object,
    },
    components: {
        AppLayout,
    },
    methods: {
        recentSongs(playlist) {
            return playlist.songs
                .splice(0, 3)
                .map((x) => x.name)
                .join(", ");
        },
    },
};
</script>

<style scoped>
.card {
    transition: 0.5s;
    opacity: 1;
    background-color: #32383e;
}
.card:hover {
    opacity: 0.75;
}
h4 {
    color: white;
}
p {
    color: gray;
}
</style>