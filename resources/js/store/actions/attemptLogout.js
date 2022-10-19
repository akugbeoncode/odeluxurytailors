import { ATTEMPT_LOGOUT } from '../store_helpers/constantVariables';

const ATTEMPT_LOGOUT_REQUEST = (context) => {
  axios.defaults.headers.common['Authorization'] =  `${context.state.tokenType} ${context.state.token}`;
  if (context.getters.isLoggedIn) {
    return new Promise((resolve, reject) => {
      axios.post('/auth/logout')
      .then(response => {
        if (response.status >= 200 && response.status < 300) {
            context.commit(ATTEMPT_LOGOUT);
        } 
        resolve(response);
      })
      .catch(error => {
        reject(error.response);
      });
    });
  }
}

export default ATTEMPT_LOGOUT_REQUEST;