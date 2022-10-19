import Vue from "vue";
import Vuex from "vuex";
import axios from 'axios';
import CKEditor from 'ckeditor4-vue';
import DisableAutocomplete from 'vue-disable-autocomplete';

axios.defaults.baseURL = 'http://localhost:8000/api/v1';
axios.defaults.withCredentials = true;

Vue.use(Vuex);
Vue.use(DisableAutocomplete);
Vue.use( CKEditor );

import state from './state';
import mutations from './mutations';
import actions from './actions';
import getters from './getters';
import modules from './modules'

export default new Vuex.Store({
  state,
  getters,
  mutations,
  actions,
  modules
});
