import {API_URL, getRequest, postRequest} from "../helpers/api";

const getAchievements = () => {
    return getRequest(`${API_URL}/api/index.php/achievements/available`);
};

const getFilteredAchievements = (filterData) => {
    return postRequest(`${API_URL}/api/index.php/achievements/filtered`, filterData);
};

export {getAchievements, getFilteredAchievements}
