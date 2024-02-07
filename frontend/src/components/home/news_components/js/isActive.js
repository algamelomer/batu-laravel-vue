export const isActive = (apiData, mainCard) => {
    const prevActiveCard = apiData.value.find(card => card.isActive);
    if (prevActiveCard) {
      prevActiveCard.isActive = false;
    }
    const activeCard = apiData.value.find(card => card.id == mainCard.value.id);
    if (activeCard) {
      activeCard.isActive = true;
    }

}

export default isActive;