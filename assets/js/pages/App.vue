<template>
    <div @wheel.prevent
        @touchmove.prevent
        @scroll.prevent
        class="tw-h-[100vh] tw-overflow-hidden"
        :class="themes[theme].bg.mainColor"
    >
        <router-view
            @theme="(event) => theme = event"
            :theme="themes[theme]">
        </router-view>
    </div>

    <div class="tw-absolute tw-bottom-0 -tw-right-[18vw] tw-h-[70vh] tw-w-[40vw] tw-rounded-t-full tw-hidden lg:tw-block"
        :class="themes[theme].bg.secondaryColor">
    </div>
</template>

<script setup>
import {ref} from "vue";

const theme = ref('trending');

const themes = ref({
    trending: {
        bg: {
            accentColor: 'tw-bg-lemony',
            mainColor: 'tw-bg-azulejo',
            secondaryColor: 'tw-bg-azulejo-dark',
        },
        text: {
            accentColor: 'tw-text-lemony',
            mainColor: 'tw-text-azulejo',
            secondaryColor: 'tw-text-azulejo-dark',
        },
        textColor: 'tw-text-white'
    },
    top: {
        bg: {
            accentColor: 'tw-bg-rose-darker',
            mainColor: 'tw-bg-rose',
            secondaryColor: 'tw-bg-rose-dark',
        },
        text: {
            accentColor: 'tw-text-rose-darker',
            mainColor: 'tw-text-rose',
            secondaryColor: 'tw-text-rose-dark',
        },
        textColor: 'tw-text-azulejo-dark'
    }
});
</script>

<style scoped>

</style>
