import axios from 'axios';

export const axiosGetRequest = (url, tokenType, token) => {
    return new Promise( (resolve, reject) => {
        axios.defaults.headers.common['Authorization'] =  `${tokenType} ${token}`;
        axios.get(url).then(response => {
            resolve(response);
        }).catch(error => { reject(error); });
    });
}