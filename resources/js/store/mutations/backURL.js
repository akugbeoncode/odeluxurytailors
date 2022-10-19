import { BACK_URL } from '../store_helpers/constantVariables';

const UPDATE_BACK_URL = (state, payload) => {
    const stringifiedBackURL = JSON.stringify(payload);

    localStorage.setItem(BACK_URL, stringifiedBackURL);
    state.backUrl = stringifiedBackURL;
}

export default UPDATE_BACK_URL;