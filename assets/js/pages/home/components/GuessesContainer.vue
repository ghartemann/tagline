<template>
    <div>
        <div v-for="guess in props.guesses">
            {{ guess.title }} ({{ formatDate(guess.release_date, 'year') }})
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
