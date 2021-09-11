const API_URL = 'server';

const getRequest = (url) => {
    return new Promise((resolve, reject) => {
        fetch(url, {mode: 'cors'})
            .then(response => response.json())
            .then(results => {
                resolve(results);
            })
            .catch((error) => {
                console.log(error);
                reject(error);
            });
    });
};

export {API_URL, getRequest}
