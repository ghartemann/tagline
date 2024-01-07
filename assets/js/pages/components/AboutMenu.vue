<template>
<div>
    <v-btn icon elevation="0" class="tw-absolute tw-top-2 tw-left-2 tw-text-lemony tw-z-30" @click="about = !about">
        <v-icon>{{ about === false ? 'mdi-help' : 'mdi-close' }}</v-icon>
    </v-btn>

    <div class="tw-absolute tw-left-[-18rem] tw-h-[70vh] tw-w-[50rem] tw-bg-azulero-dark tw-rounded-b-full tw-transition-all tw-z-10"
        :class="about === true ? 'tw-top-0' : 'tw-top-[-70vh]'">
        <div class="tw-absolute tw-left-[19rem] tw-top-[5rem] tw-text-lg tw-text-lemony tw-w-[30rem] tw-flex tw-flex-col tw-gap-10">
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

    <div class="tw-absolute tw-left-[-1.5rem] tw-h-[4.5rem] tw-top-0 tw-w-[6rem] tw-bg-azulero-darker tw-rounded-b-full tw-transition-all tw-z-20"
         :class="about === false ? 'tw-top-0' : 'tw-top-[-4.5rem]'">
    </div>
</div>
</template>

<script setup>
import {ref} from "vue";

const about = ref(false);
</script>

<style scoped>

</style>
