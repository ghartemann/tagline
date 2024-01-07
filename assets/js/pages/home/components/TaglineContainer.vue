<template>
    <div class="tw-w-full tw-flex tw-flex-col tw-items-center tw-gap-10">
        <div class="tw-text-5xl tw-text-center tw-select-none" :class="theme.textColor">
            {{ loading === true ? '...' : movie.tagline }}
        </div>
    </div>
</template>

<script setup>
import {ref, onMounted, watch, computed} from 'vue';
import axios from "axios";
import {useThemeStore} from "@stores/theme";

const loading = ref(true);
const movie = ref(null);

const themeStore = useThemeStore();
const theme = computed(() => themeStore.theme);

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
