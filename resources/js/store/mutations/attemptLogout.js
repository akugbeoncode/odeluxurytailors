import { LOGGED_USER_DETAILS, LOGGED_USER_TOKEN } from '../store_helpers/constantVariables';

const ATTEMPT_LOGOUT_REQUEST = (state) => {
    const stringifiedLoggedUserDetails = JSON.stringify({role: {}});
    localStorage.setItem(LOGGED_USER_DETAILS, stringifiedLoggedUserDetails);
    localStorage.setItem(LOGGED_USER_TOKEN, "");

    state.token = "";
    state.loggedUser = stringifiedLoggedUserDetails;
}

export default ATTEMPT_LOGOUT_REQUEST;