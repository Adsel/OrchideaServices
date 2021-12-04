import {API_URL, getRequest} from "../helpers/api";

const getAchievements = () => {
    return getRequest(`${API_URL}/api/index.php/achievements/available`);
};

export {getAchievements}
