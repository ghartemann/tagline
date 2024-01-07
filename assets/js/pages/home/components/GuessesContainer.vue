<template>
    <div :class="theme.textColor">{{ props.guesses.length }} / 5 guesses</div>

    <div class="tw-w-full tw-flex tw-flex-col-reverse tw-gap-5">
        <div v-for="guess in props.guesses" class="tw-flex tw-justify-between tw-items-center tw-rounded-full tw-p-4 tw-pl-6" :class="theme.bg.secondaryColor">
            <div class="tw-flex tw-gap-4 tw-items-center">
                <img :src="'https://www.themoviedb.org/t/p/original/' + guess.movie.poster_path"
                     :alt="guess.movie.title + ' cover picture'"
                     class="tw-rounded-md"
                     width="32"
                >

                <div>
                    <div class="tw-font-semibold" :class="theme.textColor">
                        {{ guess.movie.title }}
                    </div>

                    <div :class="theme.textColor">
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
import {formatDate} from "@composables/Format";
import {useThemeStore} from "@stores/theme.js";
import {computed} from "vue";

const themeStore = useThemeStore();
const theme = computed(() => themeStore.theme);

const props = defineProps({
    guesses: {
        type: Array,
        required: true
    }
});
</script>

<style scoped>

</style>
