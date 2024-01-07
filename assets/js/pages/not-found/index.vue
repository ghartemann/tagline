<template>
    <div class="tw-w-full tw-h-[100vh] tw-flex tw-flex-col tw-justify-center tw-items-center tw-gap-10">
        <TaglineLogo></TaglineLogo>

        <h1 class="tw-text-5xl tw-text-white tw-select-none">
            Well, that's a <span class="tw-text-lemony">404</span>.
        </h1>

        <div class="tw-text-white">{{ randomTagline.tl }} - {{ randomTagline.movie }}</div>

        <router-link to="/"
             class="tw-px-5 tw-py-3 tw-rounded-xl tw-bg-azulejo-dark tw-flex tw-items-center tw-justify-center tw-text-center tw-text-white hover:tw-text-lemony tw-text-2xl hover:tw-brightness-110 tw-transition-all tw-cursor-pointer hover:tw-shadow-md">
            Go back home
        </router-link>
    </div>
</template>

<script setup>
import {ref} from "vue";
import TaglineLogo from "@pages/components/TaglineLogo.vue";

const taglines = ref([
    {
        tl: "Even a hitman deserves a second shot.",
        movie: "Grosse Pointe Blank"
    },
    {
        tl: "If at first you don't succeed, lower your standards.",
        movie: "Tommy Boy"
    },
    {
        tl: "Everyone wants to be found.",
        movie: "Lost in Translation"
    },
    {
        tl: "Houston, we have a problem.",
        movie: "Apollo 13"
    }
]);

const randomTagline = ref(getRandomTagline());

function getRandomTagline() {
    return taglines.value[Math.floor(Math.random() * taglines.value.length)];
}
</script>

<style scoped>

</style>
