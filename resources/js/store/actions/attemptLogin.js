import { ATTEMPT_LOGIN } from '../store_helpers/constantVariables';

const ATTEMPT_LOGIN_REQUEST = ({commit}, payload) => {
    return new Promise((resolve, reject) => {
        axios.post('/auth/login', payload, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            }})
        .then(response => {
            if (response.data.access_token) {
                commit(ATTEMPT_LOGIN, {
                    accessToken: response.data.access_token,
                    tokenType: response.data.token_type,
                    loggedUser: response.data.user
                });
            } 
            resolve(response);
        })
        .catch(error => {
            reject(error.response);
        });
    });
}

export default ATTEMPT_LOGIN_REQUEST;