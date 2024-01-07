<template>
    <div class="tw-w-full tw-flex tw-flex-col tw-items-center tw-gap-10">
        <div class="tw-text-5xl tw-text-center tw-select-none" :class="theme.textColor">
            {{ props.loading === true ? '...' : history.movie.tagline }}
        </div>
    </div>
</template>

<script setup>
import {computed} from 'vue';
import {useThemeStore} from "@stores/theme";

const themeStore = useThemeStore();
const theme = computed(() => themeStore.theme);

const props = defineProps({
    history: {
        type: Object,
        required: true
    },
    loading: {
        type: Boolean,
        required: true
    }
})
</script>

<style scoped>

</style>
