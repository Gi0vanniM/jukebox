<template>
    <button v-on:click="goBack()" class="btn back-button">
        <i class="fas fa-arrow-left"></i>
    </button>
</template>

<script>
export default {
    methods: {
        goBack() {
            window.history.back();
        }
    }
};
</script>

<style>
    .back-button {
        color: black;
        border-radius: 50%;
        border-width: 1px;
        border-style: solid;
        border-color: black;
    }
    .back-button:hover {
        background-color: rgb(50, 159, 255);
    }
</style>