<template>
    <div class="tw-w-full tw-flex tw-justify-end">
        <div class="tw-flex tw-justify-around tw-gap-10 tw-px-10">
            <div v-for="tab in tabs"
                 @click="click(tab)"
                 class="tw-text-xl tw-cursor-pointer tw-py-3 tw-flex tw-gap-2"
                 :class="tab.active === true ? [theme.text.accentColor, theme.border.accentColor, 'tw-border-b-4', 'tw-font-semibold'].join(' ') : theme.textColor"
            >
                <v-icon>{{ tab.icon }}</v-icon>
                {{ translations.tabSelector[tab.slug][language] }}
            </div>
        </div>
    </div>
</template>

<script setup>
import {computed, ref} from "vue";
import {useThemeStore} from "@stores/theme";
import {useLanguageStore} from "@stores/language";

const themeStore = useThemeStore();
const theme = computed(() => themeStore.theme);

const languageStore = useLanguageStore();
const language = computed(() => languageStore.language);
const translations = computed(() => languageStore.translations);

const model = defineModel();

const tabs = ref([
    {
        slug: 'trending',
        icon: 'mdi-trending-up',
        active: true,
    },
    {
        slug: 'top',
        icon: 'mdi-trophy-outline',
        active: false,
    }
]);

function click(item) {
    tabs.value.forEach((t) => {
        t.active = false;
    });

    item.active = true;
    model.value = item.slug;

    themeStore.changeTheme(item.slug);
}
</script>

<style scoped>

</style>
