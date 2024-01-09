<template>
    <div class="tw-w-full tw-flex tw-justify-center tw-items-center tw-gap-5">
        <v-autocomplete
            @update:search="search($event)"
            v-model="model"
            :items="results"
            placeholder="Take a guess"
            :clearable="true"
            :autofocus="true"
            color="white"
            :hide-no-data="true" hide-details
            :return-object="true"
            :flat="true"
            :multiple="false"
            class="tw-w-full"
            variant="solo"
            :menu-props='{maxHeight: 300, closeOnContentClick: true, closeOnBack: true, maxWidth: 300}'>
            <template #item="{ props, item }">
                <v-list-item
                    v-bind="props"
                    :title="item.title"
                    class="tw-flex tw-gap-2"
                    rounded="xl"
                    :subtitle="'(' + useFormatDate(item.raw.release_date, 'year') + ')'"
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
import {computed, onMounted, ref, watch} from 'vue';
import axios from "axios";
import {useFormatDate} from "@composables/Format";

const model = defineModel();

const loading = ref(false);
const selectedId = ref(null);
const searchTimeout = ref(null);
const results = ref([]);

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

const backgroundJunction = computed(() => {
    return loading.value === true && results.value.length === 0 ? 'transparent' : 'white';
});
</script>

<style lang="scss">
.v-locale--is-ltr {
    border-radius: 2rem !important;
}

.v-autocomplete__content {
    border-radius: 0 0 2rem 2rem !important;
    box-shadow: none;
}

.v-list {
    @apply tw-p-2;
}

.v-autocomplete--active-menu {
    border-radius: 2rem 2rem 0 0 !important;
    background-color: v-bind(backgroundJunction) !important;
}
</style>
