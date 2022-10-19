import { BACK_URL } from '../store_helpers/constantVariables';

const UPDATE_BACK_URL = ({commit}, payload) => {
    return new Promise((resolve, reject) => {
        commit(BACK_URL, payload);
        const result = true;
        result ? resolve(result) : reject(result);
    });
}

export default UPDATE_BACK_URL;