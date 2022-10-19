import { UPDATE_LOGGED_USER_DETAILS } from '../store_helpers/constantVariables';

const ATTEMPT_UPDATING_LOGGED_USER_DETAILS_REQUEST = ({commit}, payload) => {
    return new Promise((resolve, reject) => {
        commit(UPDATE_LOGGED_USER_DETAILS, payload);
        const result = true;
        result ? resolve(result) : reject(result);
    });
}

export default ATTEMPT_UPDATING_LOGGED_USER_DETAILS_REQUEST;