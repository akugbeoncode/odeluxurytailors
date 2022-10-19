import { LOGGED_USER_DETAILS, LOGGED_USER_TOKEN, LOGGED_USER_TOKEN_TYPE } from '../store_helpers/constantVariables';

const ATTEMPT_LOGIN_REQUEST = (state, payload) => {
    const stringifiedLoggedUserDetails = JSON.stringify(payload.loggedUser);

    localStorage.setItem(LOGGED_USER_TOKEN, payload.accessToken);
    state.token = payload.accessToken;

    localStorage.setItem(LOGGED_USER_TOKEN_TYPE, payload.tokenType);
    state.tokenType = payload.tokenType;

    localStorage.setItem(LOGGED_USER_DETAILS, stringifiedLoggedUserDetails);
    state.loggedUser = stringifiedLoggedUserDetails;
   
}

export default ATTEMPT_LOGIN_REQUEST;