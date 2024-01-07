<template>
    <div>
        <AboutMenu></AboutMenu>

        <TabSelector v-model="tab" :theme="props.theme"></TabSelector>

        <div class="tw-w-full tw-h-full tw-flex tw-items-start tw-pt-5">
            <div class="tw-w-full lg:tw-w-[72rem] tw-mx-auto tw-flex tw-flex-col tw-gap-24 tw-items-center tw-justify-center">
                <TaglineLogo :theme="tab"></TaglineLogo>

                <div class="tw-w-1/2 tw-flex tw-flex-col tw-gap-10 tw-items-center tw-justify-center">
                    <TaglineContainer
                        :history="history"
                        :loading="loading">
                    </TaglineContainer>

                    <AutocompleteContainer
                        v-if="hasWon === false"
                        v-model="guess"
                        :history="history">
                    </AutocompleteContainer>

                    <GuessesContainer
                        :history="history"
                        :guesses="guesses">
                    </GuessesContainer>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {computed, onMounted, ref, watch} from "vue";
import axios from "axios";

import TaglineContainer from "@pages/home/components/TaglineContainer.vue";
import AutocompleteContainer from "@pages/home/components/AutocompleteContainer.vue";
import GuessesContainer from "@pages/home/components/GuessesContainer.vue";
import TabSelector from "@pages/components/TabSelector.vue";
import AboutMenu from "@pages/components/AboutMenu.vue";
import TaglineLogo from "@pages/components/TaglineLogo.vue";

const emit = defineEmits(["theme"]);

const props = defineProps({
    theme: {
        type: Object,
        required: true
    }
});
const loading = ref(true);
const verifying = ref(false);
const tab = ref('trending');
const guess = ref(null);
const guesses = ref([]);
const history = ref({});

const hasWon = computed(() => {
    let hasWon = false;

    if (guesses.value.length > 0) {
        hasWon = guesses.value[guesses.value.length - 1].result === true;
    }

    return hasWon;
});

onMounted(() => {
    fetchTagline();

    const guessesFromStorage = localStorage.getItem('guesses');

    if (guessesFromStorage) {
        guesses.value = JSON.parse(guessesFromStorage);
    }
});

function fetchTagline() {
    loading.value = true;

    axios.get('/history/newest/trending').then((r) => {
        history.value = r.data;
    }).catch((e) => {
        console.log(e);
    }).finally(() => {
        loading.value = false;
    });
}

function verify(id) {
    verifying.value = true;
    loading.value = true;

    axios.all([
        axios.get('/history/verify/trending/' + id),
        axios.get('/history/newest/' + tab.value)
    ]).then(axios.spread((
        verifyRequest,
        historyRequest,
    ) => {
        guesses.value[guesses.value.length - 1].result = verifyRequest.data;
        history.value = historyRequest.data;
    })).catch((e) => {
        console.error(e);
    }).finally(() => {
        verifying.value = false;
        loading.value = false;
    });
}

watch(tab, (value) => {
    emit('theme', value);
});

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
</script>

<style scoped>

</style>
