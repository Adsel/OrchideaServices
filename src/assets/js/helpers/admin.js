import {LOCAL_STORAGE_KEY_LOGGED_ADMIN} from "@/assets/js/variables/auth";

const getLoggedAdmin = () => {
    const loggedAdminString = localStorage.getItem(LOCAL_STORAGE_KEY_LOGGED_ADMIN);
    if (loggedAdminString) {
        return JSON.parse(loggedAdminString);
    }

    return null;
};

const logoutAdmin = () => {
    localStorage.removeItem(LOCAL_STORAGE_KEY_LOGGED_ADMIN);
    location.reload();
};

const getLoggedAdminId = () => {
    const loggedAdmin = getLoggedAdmin();

    return loggedAdmin ? loggedAdmin.administrator_id : null;
};

export {getLoggedAdmin, getLoggedAdminId, logoutAdmin};
