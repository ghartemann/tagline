<template>
    <div class="tw-w-full tw-flex tw-flex-col tw-items-center tw-gap-10">
        <div class="tw-text-5xl tw-text-white tw-text-center tw-select-none">
            {{ loading === true ? '...' : movie.tagline }}
        </div>
    </div>
</template>

<script setup>
import {ref, onMounted, watch} from 'vue';
import axios from "axios";

const loading = ref(true);
const movie = ref(null);

function fetchTagline() {
    loading.value = true;

    axios.get('/history/newest/trending').then((r) => {
        movie.value = r.data.movie;
    }).catch((e) => {
        console.log(e);
    }).finally(() => {
        loading.value = false;
    });
}

onMounted(() => {
    fetchTagline();
});
</script>

<style scoped>

</style>
