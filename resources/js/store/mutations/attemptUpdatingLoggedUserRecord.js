import { UPDATE_LOGGED_USER_DETAILS } from '../store_helpers/constantVariables';

import { LOGGED_USER_DETAILS } from '../store_helpers/constantVariables';

const ATTEMPT_UPDATING_LOGGED_USER_DETAILS_REQUEST = (state, payload) => {
    const stringifiedLoggedUserDetails = JSON.stringify(payload.loggedUser);

    localStorage.setItem(LOGGED_USER_DETAILS, stringifiedLoggedUserDetails);
    state.loggedUser = stringifiedLoggedUserDetails; 
}

export default ATTEMPT_UPDATING_LOGGED_USER_DETAILS_REQUEST;