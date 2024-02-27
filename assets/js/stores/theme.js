import {defineStore} from "pinia";
import resolveConfig from 'tailwindcss/resolveConfig';
import tailwindConfig from '../../../tailwind.config.js';
const fullConfig = resolveConfig(tailwindConfig);

export const useThemeStore = defineStore('themes', {
    state: () => ({
        theme: {
            raw: {
                accentColor: fullConfig.theme.colors.lemony,
                mainColor: fullConfig.theme.colors.azulejo,
                secondaryColor: fullConfig.theme.colors['azulejo-dark'],
                tertiaryColor: fullConfig.theme.colors['azulejo-darker'],
                logo: {
                    text: fullConfig.theme.colors.lemony,
                    star: fullConfig.theme.colors['azulejo-dark']
                }
            },
            bg: {
                accentColor: 'tw-bg-lemony',
                mainColor: 'tw-bg-azulejo',
                secondaryColor: 'tw-bg-azulejo-dark',
                tertiaryColor: 'tw-bg-azulejo-darker'
            },
            text: {
                accentColor: 'tw-text-lemony',
                mainColor: 'tw-text-azulejo',
                secondaryColor: 'tw-text-azulejo-dark',
                tertiaryColor: 'tw-text-azulejo-darker'
            },
            border: {
                accentColor: 'tw-border-lemony',
                mainColor: 'tw-border-azulejo',
                secondaryColor: 'tw-border-azulejo-dark',
                tertiaryColor: 'tw-border-azulejo-darker'
            },
            textColor: 'tw-text-white'
        },
        themes: {
            trending: {
                raw: {
                    accentColor: fullConfig.theme.colors.lemony,
                    mainColor: fullConfig.theme.colors.azulejo,
                    secondaryColor: fullConfig.theme.colors['azulejo-dark'],
                    tertiaryColor: fullConfig.theme.colors['azulejo-darker'],
                    logo: {
                        text: fullConfig.theme.colors.lemony,
                        star: fullConfig.theme.colors['azulejo-dark']
                    }
                },
                bg: {
                    accentColor: 'tw-bg-lemony',
                    mainColor: 'tw-bg-azulejo',
                    secondaryColor: 'tw-bg-azulejo-dark',
                    tertiaryColor: 'tw-bg-azulejo-darker'
                },
                text: {
                    accentColor: 'tw-text-lemony',
                    mainColor: 'tw-text-azulejo',
                    secondaryColor: 'tw-text-azulejo-dark',
                    tertiaryColor: 'tw-text-azulejo-darker'
                },
                border: {
                    accentColor: 'tw-border-lemony',
                    mainColor: 'tw-border-azulejo',
                    secondaryColor: 'tw-border-azulejo-dark',
                    tertiaryColor: 'tw-border-azulejo-darker'
                },
                textColor: 'tw-text-white'
            },
            top: {
                raw: {
                    accentColor: fullConfig.theme.colors.purply,
                    mainColor: fullConfig.theme.colors.rose,
                    secondaryColor: fullConfig.theme.colors['rose-dark'],
                    tertiaryColor: fullConfig.theme.colors['rose-darker'],
                    logo: {
                        text: fullConfig.theme.colors.azulejo,
                        star: fullConfig.theme.colors['rose-darker']
                    }
                },
                bg: {
                    accentColor: 'tw-bg-purply',
                    mainColor: 'tw-bg-rose',
                    secondaryColor: 'tw-bg-rose-dark',
                    tertiaryColor: 'tw-bg-rose-darker'
                },
                text: {
                    accentColor: 'tw-text-purply',
                    mainColor: 'tw-text-rose',
                    secondaryColor: 'tw-text-rose-dark',
                    tertiaryColor: 'tw-text-rose-darker'
                },
                border: {
                    accentColor: 'tw-border-purply',
                    mainColor: 'tw-border-rose',
                    secondaryColor: 'tw-border-rose-dark',
                    tertiaryColor: 'tw-border-rose-darker'
                },
                textColor: 'tw-text-azulejo-dark'
            }
        },
    }),
    actions: {
        changeTheme(tab) {
            this.theme = this.themes[tab];
        }
    }
});
