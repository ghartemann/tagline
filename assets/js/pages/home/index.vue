<template>
    <div>
        <AboutMenu></AboutMenu>

        <TabSelector v-model="tab" :theme="props.theme"></TabSelector>

        <div class="tw-w-full tw-h-full tw-flex tw-items-start">
            <div class="tw-w-full lg:tw-w-[72rem] tw-mx-auto tw-flex tw-flex-col tw-gap-16 tw-items-center tw-justify-center">
                <TaglineLogo :theme="tab"></TaglineLogo>

                <div class="tw-w-1/2 tw-flex tw-flex-col tw-gap-10 tw-items-center tw-justify-center">
                    <TaglineContainer
                        :history="history"
                        :loading="loading">
                    </TaglineContainer>

                    <AutocompleteContainer
                        v-if="hasWon === false && hasLost === false"
                        v-model="guess"
                        :history="history">
                    </AutocompleteContainer>

                    <GuessesContainer
                        :history="history"
                        :guesses="guesses[tab]"
                        :hasWon="hasWon"
                        :hasLost="hasLost">
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
import moment from "moment";

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
const guesses = ref({
    trending: [],
    top: []
});
const history = ref({});

const hasWon = computed(() => {
    let hasWon = false;

    if (guesses.value[tab.value].length > 0) {
        hasWon = guesses.value[tab.value][guesses.value[tab.value].length - 1].result === true;
    }

    return hasWon;
});

const hasLost = computed(() => {
    let hasLost = false;

    if (guesses.value[tab.value].length > 0 && guesses.value[tab.value].length === 5) {
        hasLost = guesses.value[tab.value][guesses.value[tab.value].length - 1].result === false;
    }

    return hasLost;
});

onMounted(() => {
    fetchTagline();

    const guessesFromStorage = localStorage.getItem(moment().format('YYYY-MM-DD'));

    if (guessesFromStorage) {
        guesses.value = JSON.parse(guessesFromStorage);
    }
});

function fetchTagline() {
    loading.value = true;

    axios.get(`/history/newest/${tab.value}`).then((r) => {
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
        axios.get(`/history/verify/${tab.value}/${id}`),
        axios.get(`/history/newest/${tab.value}`),
        axios.get(`/movie/similar/${tab.value}/${id}`)
    ]).then(axios.spread((
        verifyRequest,
        historyRequest,
        similarRequest
    ) => {
        guesses.value[tab.value][guesses.value[tab.value].length - 1].result = verifyRequest.data;
        history.value = historyRequest.data;
        guesses.value[tab.value][guesses.value[tab.value].length - 1].similar = similarRequest.data;
    })).catch((e) => {
        console.error(e);
    }).finally(() => {
        verifying.value = false;
        loading.value = false;
    });
}

watch(tab, (value) => {
    emit('theme', value);
    fetchTagline();
});

watch(guess, (value) => {
    if (value) {
        guesses.value[tab.value].push(
            {
                movie: value,
                result: null
            }
        );

        verify(value.id);
    }
});

watch(guesses, (value) => {
    const date = moment().format('YYYY-MM-DD');
    localStorage.setItem(date, JSON.stringify(value));
}, {deep: true});
</script>

<style scoped>

</style>
