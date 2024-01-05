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
