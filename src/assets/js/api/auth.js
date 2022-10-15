import {API_URL, postRequest} from "@/assets/js/helpers/api";

const loginAdministrator = (authData) => {
    return postRequest(`${API_URL}/index.php/auth/login`, authData);
};

export {loginAdministrator};
