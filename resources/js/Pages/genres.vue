<template>
    <div v-for="genre in genres" :key="genre">
        {{ genre.name }}
    </div>
</template>

<script>
export default {
    props: {
        genres: Array,
    }
}
</script>

<style>

</style>