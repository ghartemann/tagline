<template>
    <div class="tw-w-full tw-flex tw-flex-row-reverse tw-justify-center tw-items-center tw-gap-10 tw-group">
        <div class="tw-hidden group-hover:tw-block tw-absolute">
            <v-btn :icon="true" flat :color="theme.raw.secondaryColor" @click="fr = !fr">
                <v-icon :class="theme.textColor">mdi-translate</v-icon>
            </v-btn>
        </div>

        <div class="tw-text-5xl tw-text-center tw-select-none" :class="theme.textColor">
            {{ history.movie?.[fr ? 'taglineFr' : 'tagline'] ?? '...' }}
        </div>
    </div>
</template>

<script setup>
import {computed, ref} from 'vue';
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

const fr = ref(false);
</script>

<style scoped>

</style>
