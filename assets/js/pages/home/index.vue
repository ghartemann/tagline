<template>
    <div class="tw-w-full tw-h-full tw-flex tw-justify-center tw-items-start tw-pt-10">
        <div class="tw-w-[72rem] tw-flex tw-flex-col tw-gap-10 tw-items-center tw-justify-center">
            <img src="@images/logo.svg" alt="logo">

            <TaglineContainer></TaglineContainer>

            <AutocompleteContainer v-model="guess"></AutocompleteContainer>

            <GuessesContainer :guesses="guesses"></GuessesContainer>
        </div>

        <div class="tw-absolute tw-bottom-0 tw-right-[-18rem] tw-h-[70vh] tw-w-[40rem] tw-bg-azulero-dark tw-rounded-t-full"></div>
    </div>
</template>

<script setup>
import TaglineContainer from './components/TaglineContainer.vue'
import AutocompleteContainer from "@pages/home/components/AutocompleteContainer.vue";
import GuessesContainer from "@pages/home/components/GuessesContainer.vue";
import {ref, watch} from "vue";

const guess = ref(null);
const guesses = ref([]);

watch(guess, (value) => {
    if (value) {
        guesses.value.push(value[0]);
        guess.value = null;
    }
});
</script>

<style scoped>

</style>
