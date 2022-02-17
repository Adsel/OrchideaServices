import {API_URL, getRequest, postRequest} from "../helpers/api";

const getAchievements = () => {
    return getRequest(`${API_URL}/api/index.php/achievements/available`);
};

const getFilteredAchievements = (filterData) => {
    return postRequest(`${API_URL}/api/index.php/achievements/filtered`, filterData);
};

const changeAchievementsStates = (achievementsData) => {
    // TODO: make PUT Request
    return postRequest(`${API_URL}/api/index.php/achievements/statuses`, achievementsData);
};

export {changeAchievementsStates, getAchievements, getFilteredAchievements}
