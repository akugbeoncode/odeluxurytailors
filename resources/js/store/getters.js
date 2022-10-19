import { isEmptyObject } from '../helpers/isEmptyObject';

const getters = {
  isLoggedIn(state) {
    return state.token !== "" && !isEmptyObject(JSON.parse(state.loggedUser));
  },

  isLoading(state) {
    return JSON.parse(state.isLoading);
  },

  loggedUser(state) {
    return JSON.parse(state.loggedUser);
  },

  token(state) {
    return state.token;
  },

  tokenType(state) {
    return state.tokenType;
  },

  alertMessages(state) {
    return JSON.parse(state.alertMessages);
  },

  backURL(state) {
    return JSON.parse(state.backUrl);
  }
};

export default getters;