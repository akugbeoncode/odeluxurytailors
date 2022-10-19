import { IS_LOADING, LOGGED_USER_DETAILS, LOGGED_USER_TOKEN, LOGGED_USER_TOKEN_TYPE, ALERT_MESSAGES, BACK_URL } from './store_helpers/constantVariables';

const state = {
    token: localStorage.getItem(LOGGED_USER_TOKEN) || "",
    tokenType: localStorage.getItem(LOGGED_USER_TOKEN_TYPE) || "",
    loggedUser: localStorage.getItem(LOGGED_USER_DETAILS) || '{}',
    isLoading: localStorage.getItem(IS_LOADING) || 'false',
    alertMessages: localStorage.getItem(ALERT_MESSAGES) || '[]',
    backUrl: localStorage.getItem(BACK_URL) || '{}',
};

export default state;