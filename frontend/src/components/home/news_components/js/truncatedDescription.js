export const truncatedDescription = (text, numWordsToShow) => {
    const words = text.split(' ');
    const truncatedText = words.slice(0, numWordsToShow).join(' ');
    const readMoreText = words.length > numWordsToShow ? ' ReadMore...' : '';
    return truncatedText + readMoreText;}

    export default truncatedDescription;

