
  export const random_style = () => {
    const randomNumber = Math.floor(Math.random() * 3) + 1;

    const style = [
        [
          {
            "id": 1,
            "title": "#204865",
            "bg": "#76ADD4",
            "btn": "#204865",
            "content": "#C9DEEE",
            "img": "#204865",
          },
          {
            "id": 2,
            "title": "#1B4A4B",
            "bg": "#2D7C7F",
            "btn": "#1B4A4B",
            "content": "#99D9DB",
            "img": "#99D9DB",
          },
          {
            "id": 3,
            "title": "#2D312B;",
            "bg": "#E4E6E3",
            "btn": "#2D312B",
            "content": "#879083",
            "img": "#879083",
          }
        ]
      ];
    

    for (const items of style) {
      const foundItem = items.find(item => item.id === randomNumber);
      if (foundItem) {
        return foundItem;
      }
    }
    return null; 
  };

  export default random_style;
