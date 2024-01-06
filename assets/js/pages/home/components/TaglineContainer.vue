<template>
    <div class="tw-w-full tw-flex tw-flex-col tw-items-center tw-gap-10">
        <div class="tw-text-5xl tw-text-white tw-text-center tw-select-none">
            {{ tagline }}
        </div>
    </div>
</template>

<script setup>
import {ref, onMounted, watch} from 'vue';
import axios from "axios";

const tagline = ref('');

function fetchTagline() {
    axios.get('/movie/tagline').then((r) => {
        tagline.value = r.data;
    }).catch((e) => {
        console.log(e);
    });
}

onMounted(() => {
    fetchTagline();
});
</script>

<style scoped>

</style>
