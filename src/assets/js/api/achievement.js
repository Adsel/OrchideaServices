import {API_URL, getRequest, postRequest} from "../helpers/api";

const getAchievements = () => {
    return getRequest(`${API_URL}/api/index.php/achievements/available`);
};

const getFilteredAchievements = (filterData) => {
    return postRequest(`${API_URL}/api/index.php/achievements/filtered`, filterData);
};

const changeAchievementState = (achievementData) => {
    // TODO: make PUT Request
    return postRequest(`${API_URL}/api/index.php/achievement/status`, achievementData);
};

export {changeAchievementState, getAchievements, getFilteredAchievements}
