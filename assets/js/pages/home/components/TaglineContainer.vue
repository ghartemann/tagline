<template>
    <div class="tw-w-full">
        <div class="tw-text-5xl tw-text-white">{{ tagline }}</div>

        <v-autocomplete
            @update:search="search($event)"
            v-model="input"
            :items="results"
            :loading="loading"
            placeholder="Devinez"
            :clearable="true"
            hide-selected
            :autofocus="true"
            color="white"
            hide-no-data
            return-object
            rounded
            variant="solo"
            :menu-props="{ maxHeight: 200 }">
        </v-autocomplete>

        <div class="tw-p-3 tw-rounded-xl tw-bg-white tw-flex tw-items-center tw-justify-center tw-text-center">Envoyer</div>
    </div>
</template>

<script setup>
import {ref, onMounted, watch} from 'vue';
import axios from "axios";

const tagline = ref('');

function fetchTagline() {
    axios.get('/movie/tagline').then((r) => {
        tagline.value = r.data;
    }).catch((e) => {
        console.log(e);
    });
}

const loading = ref(false);
const input = ref(null);
const selectedId = ref(null);
const searchTimeout = ref(null);
const results = ref([]);

function search(value) {
    if (searchTimeout.value !== null) {
        clearTimeout(searchTimeout.value);
    }

    if (value != null && value !== '') {
        loading.value = true;

        searchTimeout.value = setTimeout(
            () => axios.get('/movie/search/' + value).then((r) => {
                results.value = r.data;
            }).catch((error) => {
                console.error(error);
            }).finally(() => {
                loading.value = false;
            }),
            500);
    } else {
        loading.value = false;
    }
}

watch(() => input.value, (value) => {
    if (value !== null && value !== '') {
        selectedId.value = value.id;
    }
});

onMounted(() => {
    fetchTagline();
});
</script>

<style scoped>

</style>
