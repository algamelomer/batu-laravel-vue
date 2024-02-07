export const filterData = (Data, apiData, filter, type) => {

    const pass = Data.filter(item => item[filter] == type);
    apiData.value = pass.map((item, index) => ({
        ...item,
        isActive: false,
    }));
}

export default filterData;