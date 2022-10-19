require('./bootstrap');

import "mutationobserver-shim";
import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";

import { MANAGER, TAILOR, LAUNDRY, FRONT_DESK} from './store/store_helpers/constantVariables';

window.EventBus = new Vue();

Vue.config.productionTip = false;
Vue.config.devtools = true;
Vue.config.performance = true;  

const vueUIRender = document.getElementById('app');

router.beforeEach((to, from, next) => {
  const isLoggedIn = store.getters.isLoggedIn;
  const loggedUser = store.getters.loggedUser;

  console.log("++++++>>>>>>>>>", to)
  console.log("is logged ined to",  isLoggedIn)
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!isLoggedIn) {
      next({
        name: "ManagementLogin",
        query: {
          redirect: to.fullPath
        }
      })
    } else {
      next()
    }
  } else if (to.matched.some(record => record.meta.requiresVisitor)) {
    if (isLoggedIn) {
      if (loggedUser.role.access_level === MANAGER) {
        next({
          name: "ManagerUserAccountDashboard",
          params: {
            loggedUserID: loggedUser.id
          },
          query: {
            redirect: to.fullPath
          }
        })
      } else if (loggedUser.role.access_level === TAILOR) {
        next({
          name: "TailorUserAccountDashboard",
          params: {
            loggedUserID: loggedUser.id
          },
          query: {
            redirect: to.fullPath
          }
        })
      } else if (loggedUser.role.access_level === FRONT_DESK) {
        next({
          name: "ServiceUserAccountDashboard",
          params: {
            loggedUserID: loggedUser.id
          },
          query: {
            redirect: to.fullPath
          }
        })
      } else if (loggedUser.role.access_level === LAUNDRY) {
        next({
          name: "LaundryUserAccountDashboard",
          params: {
            loggedUserID: loggedUser.id
          },
          query: {
            redirect: to.fullPath
          }
        })
      } else {
        // Proceed to logout the user
        // Some actions will be implemented and executed here...
      }
    } else {
      next()
    }
  }
});

console.log("==============>>>>>", vueUIRender);

const app = new Vue({
  router,
  store,
  render: h => h(App)
}).$mount(vueUIRender);

export default app;
