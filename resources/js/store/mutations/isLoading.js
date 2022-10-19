import { IS_LOADING } from '../store_helpers/constantVariables';

const UPDATE_IS_LOADING = (state, payload) => {
  const stringifiedBoolean = JSON.stringify(payload);
  localStorage.setItem(IS_LOADING, stringifiedBoolean)
  state.isLoading = stringifiedBoolean;
}

export default UPDATE_IS_LOADING;