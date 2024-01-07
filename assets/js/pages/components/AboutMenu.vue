<template>
<div>
    <v-btn icon
           elevation="0"
           class="tw-absolute tw-top-2 tw-left-2 tw-z-30"
           :class="theme.textColor"
           @click="about = !about"
    >
        <v-icon>{{ about === false ? 'mdi-help' : 'mdi-close' }}</v-icon>
    </v-btn>

    <div class="tw-absolute tw-left-[-18rem] tw-h-[70vh] tw-w-[50rem] tw-rounded-b-full tw-transition-all tw-z-10"
        :class="[about === true ? 'tw-top-0' : 'tw-top-[-70vh]', theme.bg.secondaryColor]">
        <div class="tw-absolute tw-left-[19rem] tw-top-[5rem] tw-text-lg tw-w-[30rem] tw-flex tw-flex-col tw-gap-10" :class="theme.textColor">
            <div>
                <span class="tw-font-bold">Tagline</span> is a game where you have to guess the movie from its tagline.
            </div>

            <div>
                <span class="tw-font-bold">What is a tagline?</span><br>
                A movie tagline is a short text which serves to clarify an idea for, or is designed with a form of, dramatic
                effect. Many tagline slogans are reiterated phrases associated with the film.
            </div>

            <div>
                <span class="tw-font-bold">How does the game work?</span><br>
                You have 5 guesses. For each guess, you have to type<br>
                the name of the movie you think the tagline is from.
            </div>
        </div>
    </div>

    <div class="tw-absolute tw-left-[-1.2rem] tw-h-[4.5rem] tw-top-0 tw-w-[6rem] tw-rounded-b-full tw-transition-all tw-z-20"
         :class="[about === false ? 'tw-top-0' : 'tw-top-[-4.5rem]', theme.bg.tertiaryColor]">
    </div>
</div>
</template>

<script setup>
import {computed, ref} from "vue";
import {useThemeStore} from "@stores/theme";

const about = ref(false);

const themeStore = useThemeStore();
const theme = computed(() => themeStore.theme);
</script>

<style scoped>

</style>
