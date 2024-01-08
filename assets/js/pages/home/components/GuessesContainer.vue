<template>
    <div v-if="props.hasWon === true" class="tw-text-lg" :class="theme.textColor">
        Congratulations! {{ getNbWinnersHumanized(-1) }} found the answer before you did.
    </div>

    <div v-if="props.hasLost === true" class="tw-text-lg" :class="theme.textColor">
        Looks like you've lost. {{ getNbWinnersHumanized() + (nbWinners > 0 ? " didn't and" : '') }} got the answer.
    </div>

    <div class="tw-w-full tw-flex tw-flex-col-reverse tw-gap-3">
        <div v-for="(guess, index) in props.guesses" class="tw-flex tw-justify-between tw-items-center tw-rounded-full tw-p-4 tw-pl-6" :class="theme.bg.secondaryColor">
            <div class="tw-flex tw-gap-4 tw-items-center">
                <img :src="'https://www.themoviedb.org/t/p/original/' + guess.movie.poster_path"
                     :alt="guess.movie.title + ' cover picture'"
                     class="tw-rounded-md"
                     width="32"
                >

                <div>
                    <div class="tw-font-semibold" :class="theme.textColor">
                        <a :href="'https://www.themoviedb.org/movie/' + guess.movie.id" target="_blank" class="tw-font-light">
                            <span class="tw-font-semibold">{{ guess.movie.title }}</span>
                            ({{ useFormatDate(guess.movie.release_date, 'year') }})
                        </a>
                    </div>

                    <div :class="theme.textColor">{{ guess.similar === true ? 'You\'re close' : '' }}</div>
                </div>
            </div>

            <div class="tw-flex tw-items-center tw-gap-2">
                <div :class="theme.textColor" class="tw-font-semibold">
                    {{ index + 1 }}/5
                </div>

                <div>
                    <div v-if="guess.result === null">
                        <v-icon class="tw-text-white" size="40">mdi-clock-outline</v-icon>
                    </div>

                    <div v-else-if="guess.result === true">
                        <v-icon class="tw-text-green-500" size="40">mdi-check</v-icon>
                    </div>

                    <div v-else-if="guess.result === false">
                        <v-icon class="tw-text-red-500" size="40">mdi-close</v-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {useFormatDate} from "@composables/Format";
import {useThemeStore} from "@stores/theme.js";
import {computed} from "vue";

const themeStore = useThemeStore();
const theme = computed(() => themeStore.theme);

const props = defineProps({
    guesses: {
        type: Array,
        required: true
    },
    history: {
        type: Object,
        required: true
    },
    hasWon: {
        type: Boolean,
        required: true
    },
    hasLost: {
        type: Boolean,
        required: true
    }
});

const nbWinners = computed(() => {
    let nbWinners = 0;

    if (Object.keys(props.history).length > 0) {
        nbWinners = props.history.nbWinners;
    }

    return nbWinners;
});

function getNbWinnersHumanized(substract = 0) {
    const winners = nbWinners.value + substract;

    if (winners === 0) {
        return 'Nobody';
    } else if (winners === 1) {
        return '1 person';
    } else {
        return winners + ' people';
    }
}
</script>

<style scoped>

</style>
