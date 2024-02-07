export const clickhandler = (apiData, mainCard, isPaused, items) => {

    mainCard.value.title = items.title;
    mainCard.value.content = items.description;
    mainCard.value.img = items.file;
    mainCard.value.id = items.id;
    const prevActiveCard = apiData.value.find(card => card.isActive);
    if (prevActiveCard) {
      prevActiveCard.isActive = false;
    }
    const activeCard = apiData.value.find(card => card.id == mainCard.value.id);
    if (activeCard) {
      activeCard.isActive = true;
    } isPaused = true;
    setTimeout(() => {
      isPaused = false;
    }, 5000);
    
}

export default clickhandler;
