<template>
    <div class="tw-w-full tw-flex tw-flex-row-reverse tw-justify-center tw-items-center tw-gap-10 tw-group">
        <div class="tw-hidden group-hover:tw-block tw-absolute tw-z-50">
            <v-btn :icon="true" flat :color="theme.raw.secondaryColor" @click="fr = !fr">
                <v-icon :class="theme.textColor">mdi-translate</v-icon>
            </v-btn>
        </div>

        <div class="tw-text-5xl tw-text-center tw-select-none group-hover:tw-opacity-70" :class="theme.textColor">
            <div v-if="fr" class="animate__animated animate__bounceIn">
                {{ useLastCharDot(history.movie?.[fr ? 'taglineFr' : 'tagline']) ?? '...' }}
            </div>

            <div v-else class="animate__animated animate__bounceIn">
                {{ useLastCharDot(history.movie?.[fr ? 'taglineFr' : 'tagline']) ?? '...' }}
            </div>
        </div>
    </div>
</template>

<script setup>
import {computed, ref, watch} from 'vue';
import {useThemeStore} from "@stores/theme";
import {useLastCharDot} from "@composables/Format";
import {useLanguageStore} from "@stores/language";

const themeStore = useThemeStore();
const theme = computed(() => themeStore.theme);

const languageStore = useLanguageStore();
const language = computed(() => languageStore.language);

const props = defineProps({
    history: {
        type: Object,
        required: true
    },
    loading: {
        type: Boolean,
        required: true
    }
});

const fr = ref(false);

watch(() => language.value, (value) => {
    fr.value = value === 'fr';
}, {immediate: true});
</script>

<style scoped>

</style>
