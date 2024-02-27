import {defineStore} from "pinia";

export const useLanguageStore = defineStore('language', {
    state: () => ({
        language: localStorage.getItem('language') || navigator.language || 'fr',
        languages: {
            en: {
                name: 'English',
                flag: '🇬🇧',
                code: 'en'
            },
            fr: {
                name: 'Français',
                flag: '🇫🇷',
                code: 'fr'
            }
        },
        translations: {
            autocomplete: {
                placeholder: {
                    en: 'Take a guess',
                    fr: 'Devinez'
                }
            },
            tabSelector: {
                trending: {
                    en: 'Trending',
                    fr: 'Tendances'
                },
                top: {
                    en: 'Top 100',
                    fr: 'Top 100'
                }
            },
            about: {
                about1: {
                    en: 'is a game where you have to guess the movie from its tagline.',
                    fr: 'est un jeu dans lequel il faut deviner le titre du film à partir de sa phrase d\'accroche (tagline).'
                },
                about2: {
                    en: 'What even is a tagline?',
                    fr: 'C\'est quoi une tagline ?'
                },
                about3: {
                    en: 'A movie tagline is a short text which serves to clarify an idea for, or is designed with a ' +
                        'form of dramatic effect. Many tagline slogans are reiterated phrases associated with the film.',
                    fr: 'Une tagline ou phrase d\'accroche est une courte phrase qui sert à clarifier une idée ou est ' +
                        'conçue avec une forme d\'effet dramatique. De nombreuses phrases d\'accroche sont des phrases répétées associées au film.'
                },
                about4: {
                    en: 'Okay fine but how does the game work?',
                    fr: 'Ok super mais ton jeu il marche comment ?'
                },
                about5: {
                    en: 'You have five guesses. For each attempt, enter the name of the movie you believe the tagline ' +
                        'is from into the pretty large, unmissable field at the center of your screen and select the ' +
                        'correct movie from the generated list. Feel<br>free to translate the title to French if ' +
                        'necessary using<br>the adjacent button (the translation is sourced from<br>TmDB as well).',
                    fr: 'Vous avez droit à 5 essais. Pour chaque essai, tapez le<br> nom du film dont vous pensez que la ' +
                        'tagline est issue<br> dans l\'énorme champ au centre de votre écran puis sélectionnez le bon film.'
                },
                about6: {
                    en: 'And who exactly made this... thing?',
                    fr: 'Et qui a créé ce... "jeu" ?'
                }
            },
            settings: {
                language: {
                    en: 'Language',
                    fr: 'Langue'
                },
                difficulty: {
                    en: 'Difficulty',
                    fr: 'Difficulté'
                },
                difficulty2: {
                    en: 'Very hard',
                    fr: 'Très difficile'
                }
            }
        }
    }),
    getters: {
        getLanguage() {
            return this.language;
        },
        getLanguages() {
            return this.languages;
        },
        getTranslations() {
            return this.translations;
        }
    },
    actions: {
        changeLanguage() {
            this.language = this.language === 'en' ? 'fr' : 'en';
            localStorage.setItem('language', this.language);
        }
    }
});
