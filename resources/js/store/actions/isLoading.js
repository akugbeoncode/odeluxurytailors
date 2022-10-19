import { IS_LOADING } from '../store_helpers/constantVariables';

const UPDATE_IS_LOADING = ({ commit }, payload) => {
  return new Promise( (resolve, reject) => {
    commit(IS_LOADING, payload);
    const result = true;
    result ? resolve(result) : reject(result);
  });
}

export default UPDATE_IS_LOADING;

