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


export {getLoggedAdmin, logoutAdmin};
