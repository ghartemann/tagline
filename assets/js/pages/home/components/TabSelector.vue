<template>
    <div class="tw-w-full tw-flex tw-justify-around">
        <div v-for="tab in tabs"
             @click="click(tab)"
             class="tw-text-2xl tw-text-white tw-cursor-pointer"
             :class="{'tw-text-lemony tw-border-lemony tw-border-b-2': tab.active}"
        >
            <v-icon>{{ tab.icon }}</v-icon>
            {{ tab.name }}
        </div>
    </div>
</template>

<script setup>
import {ref} from "vue";

const tab = ref('Trending');

const tabs = ref([
    {
        name: 'Trending',
        icon: 'mdi-trending-up',
        active: true,
    },
    {
        name: 'Top rated',
        icon: 'mdi-trophy-outline',
        active: false,
    }
]);

function click(item) {
    tabs.value.forEach((t) => {
        t.active = false;
    });

    item.active = true;
    tab.value = item.name;
}
</script>

<style scoped>

</style>
