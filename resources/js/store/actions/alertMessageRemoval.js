import { REMOVE_ALERT_MESSAGE } from '../store_helpers/constantVariables';

const ATTEMPT_ALERT_MESSAGE_REMOVAL = ({ commit }, payload) => {
  return new Promise( (resolve, reject) => {
    commit(REMOVE_ALERT_MESSAGE, payload);
    const result = true;
    result ? resolve(result) : reject(result);
  });
}

export default ATTEMPT_ALERT_MESSAGE_REMOVAL;