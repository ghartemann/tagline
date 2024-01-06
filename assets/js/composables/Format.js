import moment from "moment";

export function strikeOutText(text) {
    const textArray = text.split(' ');

    for (let i = 0; i < textArray.length; i++) {
        const rand = Math.random();

        if (rand < 0.1) {
            textArray[i] = 'CENSORED';
        }
    }

    return textArray.join(' ');
}

export function formatDate(date, format) {
    date = moment(date);

    switch (format) {
        case 'year':
            return date.format('YYYY');
        case 'full':
            return date.format('Do MMMM YYYY, h:mm:ss a');
        default:
            return date.format('Do MMMM YYYY');
    }
}
