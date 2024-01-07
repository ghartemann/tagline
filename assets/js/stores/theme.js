import {defineStore} from "pinia";
import resolveConfig from 'tailwindcss/resolveConfig';
import tailwindConfig from '../../../tailwind.config.js';
const fullConfig = resolveConfig(tailwindConfig);

export const useThemeStore = defineStore('themes', {
    state: () => ({
        theme: {
            raw: {
                accentColor: fullConfig.theme.colors.lemony,
                mainColor: fullConfig.theme.colors.azulero,
                secondaryColor: fullConfig.theme.colors['azulero-dark'],
                tertiaryColor: fullConfig.theme.colors['azulero-darker'],
                logo: {
                    text: fullConfig.theme.colors.lemony,
                    star: fullConfig.theme.colors['azulero-dark']
                }
            },
            bg: {
                accentColor: 'tw-bg-lemony',
                mainColor: 'tw-bg-azulero',
                secondaryColor: 'tw-bg-azulero-dark',
                tertiaryColor: 'tw-bg-azulero-darker'
            },
            text: {
                accentColor: 'tw-text-lemony',
                mainColor: 'tw-text-azulero',
                secondaryColor: 'tw-text-azulero-dark',
                tertiaryColor: 'tw-text-azulero-darker'
            },
            border: {
                accentColor: 'tw-border-lemony',
                mainColor: 'tw-border-azulero',
                secondaryColor: 'tw-border-azulero-dark',
                tertiaryColor: 'tw-border-azulero-darker'
            },
            textColor: 'tw-text-white'
        },
        themes: {
            trending: {
                raw: {
                    accentColor: fullConfig.theme.colors.lemony,
                    mainColor: fullConfig.theme.colors.azulero,
                    secondaryColor: fullConfig.theme.colors['azulero-dark'],
                    tertiaryColor: fullConfig.theme.colors['azulero-darker'],
                    logo: {
                        text: fullConfig.theme.colors.lemony,
                        star: fullConfig.theme.colors['azulero-dark']
                    }
                },
                bg: {
                    accentColor: 'tw-bg-lemony',
                    mainColor: 'tw-bg-azulero',
                    secondaryColor: 'tw-bg-azulero-dark',
                    tertiaryColor: 'tw-bg-azulero-darker'
                },
                text: {
                    accentColor: 'tw-text-lemony',
                    mainColor: 'tw-text-azulero',
                    secondaryColor: 'tw-text-azulero-dark',
                    tertiaryColor: 'tw-text-azulero-darker'
                },
                border: {
                    accentColor: 'tw-border-lemony',
                    mainColor: 'tw-border-azulero',
                    secondaryColor: 'tw-border-azulero-dark',
                    tertiaryColor: 'tw-border-azulero-darker'
                },
                textColor: 'tw-text-white'
            },
            top: {
                raw: {
                    accentColor: fullConfig.theme.colors['rose-darker'],
                    mainColor: fullConfig.theme.colors.rose,
                    secondaryColor: fullConfig.theme.colors['rose-dark'],
                    tertiaryColor: fullConfig.theme.colors['rose-darker'],
                    logo: {
                        text: fullConfig.theme.colors.azulero,
                        star: fullConfig.theme.colors['rose-darker']
                    }
                },
                bg: {
                    accentColor: 'tw-bg-rose-darker',
                    mainColor: 'tw-bg-rose',
                    secondaryColor: 'tw-bg-rose-dark',
                    tertiaryColor: 'tw-bg-rose-darker'
                },
                text: {
                    accentColor: 'tw-text-rose-darker',
                    mainColor: 'tw-text-rose',
                    secondaryColor: 'tw-text-rose-dark',
                    tertiaryColor: 'tw-text-rose-darker'
                },
                border: {
                    accentColor: 'tw-border-rose-darker',
                    mainColor: 'tw-border-rose',
                    secondaryColor: 'tw-border-rose-dark',
                    tertiaryColor: 'tw-border-rose-darker'
                },
                textColor: 'tw-text-azulero-dark'
            }
        },
    }),
    actions: {
        changeTheme(tab) {
            this.theme = this.themes[tab];
        }
    }
});
