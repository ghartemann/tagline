<template>
    <div class="tw-w-full tw-flex tw-flex-col tw-gap-5">
        <div>{{ props.guesses.length }} / 5 guesses</div>

        <div v-for="guess in props.guesses" class="tw-flex tw-justify-between tw-items-center">
            <div class="tw-flex tw-gap-4 tw-items-center">
                <img :src="'https://www.themoviedb.org/t/p/original/' + guess.movie.poster_path"
                     :alt="guess.movie.title + ' cover picture'"
                     class="tw-rounded-md"
                     width="32"
                >

                <div>
                    <div class="tw-font-semibold tw-text-white">
                        {{ guess.movie.title }}
                    </div>

                    <div class="tw-text-white">
                        ({{ formatDate(guess.movie.release_date, 'year') }})
                    </div>
                </div>
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
</template>

<script setup>
import {formatDate} from "../../../composables/Format";

const props = defineProps({
    guesses: {
        type: Array,
        required: true
    }
});
</script>

<style scoped>

</style>
