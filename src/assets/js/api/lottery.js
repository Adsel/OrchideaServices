import {API_URL, getRequest} from "../helpers/api";

const getTimer = () => {
    return getRequest(`${API_URL}/api/index.php/lottery/timer`);
};

export {getTimer}
