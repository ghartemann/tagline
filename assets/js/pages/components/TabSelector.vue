<template>
    <div class="tw-w-full tw-flex tw-justify-end">
        <div class="tw-flex tw-justify-around tw-gap-10 tw-px-10">
            <div v-for="tab in tabs"
                 @click="click(tab)"
                 class="tw-text-xl tw-text-white tw-cursor-pointer tw-py-2"
                 :class="{'tw-text-lemony tw-border-lemony tw-border-b-4': tab.active}"
            >
                <v-icon>{{ tab.icon }}</v-icon>
                {{ tab.name }}
            </div>
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
        name: 'Top 100',
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
