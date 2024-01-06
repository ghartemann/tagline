<template>
    <div class="tw-w-full tw-flex tw-flex-col tw-items-center">
        <TabSelector></TabSelector>

        <div class="tw-text-5xl tw-text-white">{{ tagline }}</div>

        <div class="tw-w-1/2 tw-flex tw-flex-col tw-justify-center tw-items-center">
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
                class="tw-w-full"
                variant="solo"
                :menu-props="{ maxHeight: 200 }">
                <template #item="{ item }">
                    <div class="tw-flex tw-items-center tw-my-2 tw-gap-2 hover:tw-bg-amber-200 tw-px-3" v-bind="item">
                        <img :src="'https://www.themoviedb.org/t/p/original/' + item.raw.poster_path"
                             :alt="item.title + ' cover picture'"
                             class="tw-rounded-md"
                             width="48"
                        >

                        <div class="tw-font-semibold">{{item.title}}</div>

                        <div class="tw-text-gray-500">
                            ({{ formatDate(item.raw.release_date, 'year') }})
                        </div>
                    </div>
                </template>
            </v-autocomplete>

            <div class="tw-px-5 tw-py-3 tw-rounded-xl tw-bg-azulero-dark tw-flex tw-items-center tw-justify-center tw-text-center tw-text-white hover:tw-text-lemony tw-text-2xl hover:tw-brightness-110 tw-transition-all tw-cursor-pointer hover:tw-shadow-md">
                Envoyer
            </div>
        </div>
    </div>
</template>

<script setup>
import {ref, onMounted, watch} from 'vue';
import axios from "axios";
import {formatDate} from "../../../composables/Format.js";
import TabSelector from "@pages/home/components/TabSelector.vue";

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
