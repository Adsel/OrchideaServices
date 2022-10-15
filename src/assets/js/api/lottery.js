import {API_URL, getRequest} from "../helpers/api";

const getTimer = () => {
    return getRequest(`${API_URL}/index.php/lottery/timer`);
};

const getAwards = () => {
    return getRequest(`${API_URL}/index.php/lottery/result`);
}

const getPlayerNicknames = () => {
    return getRequest(`${API_URL}/index.php/lottery/nicknames`);
};

export {getAwards, getPlayerNicknames, getTimer}
