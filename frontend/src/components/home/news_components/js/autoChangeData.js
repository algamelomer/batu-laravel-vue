export const autoChangeData = (apiData, mainCard, counter, isPaused, activeCard) => {
    if (apiData.value && apiData.value.length > 0) {
        const initialItem = apiData.value[0];
        mainCard.value.title = initialItem.title;
        mainCard.value.content = initialItem.description;
        mainCard.value.img = initialItem.file;
        mainCard.value.id = initialItem.id;
        activeCard();
      }
      setInterval(() => {
        if (apiData.value.length > 0 && !isPaused) {
          const nextItem = apiData.value[counter];
          mainCard.value.title = nextItem.title;
          mainCard.value.content = nextItem.description;
          mainCard.value.img = nextItem.file;
          mainCard.value.id = nextItem.id;
          counter = (counter + 1) % apiData.value.length;
          activeCard();
        }
      }, 5000);}


      export default autoChangeData;
