<template>
    <div>
        <v-btn icon elevation="0"
               class="tw-absolute tw-top-2 tw-left-2 tw-z-40"
               :class="theme.textColor"
               @click="about = !about"
        >
            <v-icon :class="{'tw-animate-pulse': about === false}">
                {{ about === false ? 'mdi-help' : 'mdi-close' }}
            </v-icon>
        </v-btn>

        <div class="tw-absolute tw-left-[-18rem] tw-h-[80vh] tw-w-[50rem] tw-rounded-b-full tw-transition-all tw-z-10 tw-shadow-lg"
            :class="[about === true ? 'tw-top-0' : 'tw-top-[-85vh]', theme.bg.secondaryColor]">
            <div class="tw-absolute tw-left-[19rem] tw-top-[5rem] tw-text-lg tw-w-[30rem] tw-flex tw-flex-col tw-gap-10" :class="theme.textColor">
                <div>
                    <span class="tw-font-bold" :class="theme.text.accentColor">tagline.</span>
                    {{ translations.about.about1[language] }}
                </div>

                <div>
                    <span class="tw-font-bold" :class="theme.text.accentColor">{{ translations.about.about2[language] }}</span><br>
                    {{ translations.about.about3[language] }}
                </div>

                <div>
                    <span class="tw-font-bold" :class="theme.text.accentColor">Okay fine but how does the game work?</span><br>
                    <span v-html="translations.about.about5[language]"></span>
                </div>

                <div>
                    <span class="tw-font-bold" :class="theme.text.accentColor">
                        {{ translations.about.about6[language] }}
                    </span><br>

                    <a href="https://ghartemann.fr" target="_blank"
                       class="tw-flex tw-gap-2 tw-items-center"
                       :class="'hover:' + theme.text.accentColor"
                    >
                        <v-icon>mdi-link</v-icon>
                        <span class="tw-underline">ghartemann.fr</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="tw-absolute tw-left-[-1.2rem] tw-h-[4.5rem] tw-top-0 tw-w-[6rem] tw-rounded-b-full tw-transition-all tw-z-30"
             :class="[about === false ? 'tw-top-0' : 'tw-top-[-4.5rem]', theme.bg.tertiaryColor]">
        </div>
    </div>

    <div>
        <v-btn icon elevation="0"
               class="tw-absolute tw-top-2 tw-left-[4.5rem] tw-z-30"
               :class="theme.textColor"
               @click="settings = !settings"
        >
            <v-icon>
                {{ settings === false ? 'mdi-cog' : 'mdi-close' }}
            </v-icon>
        </v-btn>

        <div class="tw-absolute tw-left-[-15rem] tw-h-[70vh] tw-w-[50rem] tw-rounded-b-full tw-transition-all tw-z-10 tw-shadow-lg"
             :class="[settings === true ? 'tw-top-0' : 'tw-top-[-70vh]', theme.bg.tertiaryColor]">
            <div class="tw-absolute tw-left-[19rem] tw-top-[5rem] tw-text-lg tw-w-[30rem] tw-flex tw-flex-col tw-gap-10" :class="theme.textColor">
                <div>
                    <div class="tw-font-bold" :class="theme.text.accentColor">
                        {{ translations.settings.language[language] }}
                    </div>

                    <div @click="languageStore.changeLanguage" class="tw-cursor-pointer">
                        {{ languages[language].flag }} {{ languages[language].name }}
                    </div>
                </div>

                <div>
                    <div class="tw-font-bold" :class="theme.text.accentColor">
                        {{ translations.settings.difficulty[language] }}
                    </div>

                    <div>
                        {{ translations.settings.difficulty2[language] }}
                    </div>
                </div>

                <div>v1.{{ test }}</div>
            </div>
        </div>

        <div class="tw-absolute tw-left-[3rem] tw-h-[4.5rem] tw-top-0 tw-w-[6rem] tw-rounded-b-full tw-transition-all tw-z-20"
             :class="[settings === false ? 'tw-top-0' : 'tw-top-[-4.5rem]', theme.bg.secondaryColor]">
        </div>
    </div>
</template>

<script setup>
import {computed, ref, watch} from "vue";
import {useThemeStore} from "@stores/theme";
import {useLanguageStore} from "@stores/language";

const test = process.env.VUE_APP_TEST;
const about = ref(false);
const settings = ref(false);

const themeStore = useThemeStore();
const theme = computed(() => themeStore.theme);

const languageStore = useLanguageStore();
const language = computed(() => languageStore.language);
const languages = computed(() => languageStore.languages);
const translations = computed(() => languageStore.translations);

watch(() => about.value, (value) => {
    if (value === true) {
        settings.value = false;
    }
});

watch(() => settings.value, (value) => {
    if (value === true) {
        about.value = false;
    }
});
</script>

<style scoped>

</style>
