// const API_URL = 'https://adsel.pl/server/api'; // PROD
const API_URL = 'http://localhost:8085'; // DEV

const getRequest = (url) => {
    return new Promise((resolve, reject) => {
        fetch(url, {mode: 'cors'})
            .then(response => response.json())
            .then(results => {
                resolve(results);
            })
            .catch((error) => {
                console.error(error);
                reject(error);
            });
    });
};

const postRequest = (url, postData) => {
    return new Promise((resolve, reject) => {
        fetch(url, {
            mode: 'cors',
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                data: postData
            })
        })
            .then(response => response.json())
            .then(results => {
                resolve(results);
            })
            .catch((error) => {
                console.error(error);
                reject(error);
            });
    });
};

export {API_URL, getRequest, postRequest}
