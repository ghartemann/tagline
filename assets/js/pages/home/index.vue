<template>
    <div>
        <AboutMenu></AboutMenu>

        <TabSelector v-model="tab" :theme="props.theme"></TabSelector>

        <div class="tw-w-full tw-h-full tw-flex tw-items-start tw-pt-5">
            <div class="tw-w-full lg:tw-w-[72rem] tw-mx-auto tw-flex tw-flex-col tw-gap-24 tw-items-center tw-justify-center">
                <TaglineLogo :theme="tab"></TaglineLogo>

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
import TaglineLogo from "@pages/components/TaglineLogo.vue";

const props = defineProps({
    theme: {
        type: Object,
        required: true
    }
});

const verifying = ref(false);

const tab = ref('trending');

const emit = defineEmits(["theme"]);

watch(tab, (value) => {
    emit('theme', value);
});

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
