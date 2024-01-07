<template>
    <div class="tw-w-full tw-flex tw-justify-center tw-items-center tw-gap-5">
        <v-autocomplete
            @update:search="search($event)"
            v-model="model"
            :items="results"
            :loading="loading"
            placeholder="Devinez"
            :clearable="true"
            :autofocus="true"
            color="white"
            :hide-no-data="true" hide-details
            return-object
            rounded
            :multiple="false"
            class="tw-w-full"
            variant="solo"
            :menu-props="{maxHeight: 200, closeOnContentClick: true, closeOnBack: true}">
            <template #item="{ props, item }">
                <v-list-item
                    v-bind="props"
                    :title="item.title"
                    class="tw-flex tw-gap-2"
                    rounded="xl"
                    :subtitle="'(' + formatDate(item.raw.release_date, 'year') + ')'"
                >
                    <template #prepend>
                        <img :src="'https://www.themoviedb.org/t/p/original/' + item.raw.poster_path"
                             :alt="item.title + ' cover picture'"
                             class="tw-rounded-md"
                             width="48"
                        >
                    </template>
                </v-list-item>
            </template>
        </v-autocomplete>
    </div>
</template>

<script setup>
import {ref, watch} from 'vue';
import axios from "axios";
import {formatDate} from "../../../composables/Format.js";

const loading = ref(false);
const selectedId = ref(null);
const searchTimeout = ref(null);
const results = ref([]);

const model = defineModel();

function search(value) {
    if (searchTimeout.value !== null) {
        clearTimeout(searchTimeout.value);
    }

    if (value != null && value !== '' && value.length > 1) {
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

watch(() => model.value, (value) => {
    if (value !== null && value !== '') {
        selectedId.value = value.id;
    }
});
</script>

<style lang="scss">
.v-autocomplete__content {
    margin-top: 50px !important;
    border-radius: 2rem !important;
}

.v-list {
    padding: 0.5rem;
}
</style>
