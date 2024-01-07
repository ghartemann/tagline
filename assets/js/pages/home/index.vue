<template>
    <div>
        <AboutMenu></AboutMenu>

        <TabSelector></TabSelector>

        <div class="tw-w-full tw-h-full tw-flex tw-justify-center tw-items-start tw-pt-10">
            <div class="tw-w-[72rem] tw-flex tw-flex-col tw-gap-24 tw-items-center tw-justify-center">
                <img src="@images/logo.svg" alt="logo">

                <div class="tw-w-1/2 tw-flex tw-flex-col tw-gap-10 tw-items-center tw-justify-center">
                    <TaglineContainer></TaglineContainer>

                    <AutocompleteContainer v-model="guess"></AutocompleteContainer>

                    <GuessesContainer :guesses="guesses"></GuessesContainer>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import TaglineContainer from './components/TaglineContainer.vue'
import AutocompleteContainer from "@pages/home/components/AutocompleteContainer.vue";
import GuessesContainer from "@pages/home/components/GuessesContainer.vue";
import {onMounted, ref, watch} from "vue";
import axios from "axios";
import TabSelector from "@pages/components/TabSelector.vue";
import AboutMenu from "@pages/components/AboutMenu.vue";

const verifying = ref(false);

const guess = ref(null);
const guesses = ref([]);

watch(guess, (value) => {
    if (value) {
        guesses.value.push(
            {
                movie: value,
                result: null
            }
        );

        verify(value.id);
    }
});

watch(guesses, (value) => {
    localStorage.setItem('guesses', JSON.stringify(value));
}, {deep: true});

function verify(id) {
    verifying.value = true;

    axios.get('/history/verify/trending/' + id).then((r) => {
        guesses.value[guesses.value.length - 1].result = r.data;
    }).catch((e) => {
        console.log(e);
    }).finally(() => {
        verifying.value = false;
    });
}

onMounted(() => {
    const guessesFromStorage = localStorage.getItem('guesses');

    if (guessesFromStorage) {
        guesses.value = JSON.parse(guessesFromStorage);
    }
});
</script>

<style scoped>

</style>
