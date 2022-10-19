<template>
  <div>
    <div class="header-left">
      <router-link :to="loggedUserDashboard" class="logo">
        <img src="/images/OLTs_transparent_bg.png" width="100" height="68" alt="OLTs Logo">
      </router-link>
    </div>
    <div class="page-title-box pull-left" :style="{ position: 'fixed', top: 0, 'x-index': 50000 }">
      <h3>OLTsMS {{pageHeader}}</h3>
    </div>
    <a @click.prevent="toggleMobileMenuOption" id="mobile_btn" class="mobile_btn pull-left"><i class="fa fa-bars" aria-hidden="true"></i></a>
    <ul class="nav user-menu pull-right" style="position: fixed; top: 0; right: 0;">
      <!-- <li class="nav-item dropdown">
        <a href="#" class="dropdown-toggle nav-link pr-4 pl-4" data-toggle="dropdown"><i class="fas fa-bell"></i> <span class="badge badge-pill bg-primary pull-right">3</span></a>
        <div class="dropdown-menu notifications">
            <div class="topnav-dropdown-header">
                <span>Notifications</span>
            </div>
            <div class="drop-scroll">
              <ul class="notification-list">
                <li class="notification-message">
                  <a href="activities.html">
                    <div class="media">
                      <span class="avatar">
                        <img alt="John Doe" src="assets/img/user.jpg" class="img-fluid">
                      </span>
                      <div class="media-body">
                        <p class="noti-details"><span class="noti-title">John Doe</span> added new task <span class="noti-title">Patient appointment booking</span></p>
                        <p class="noti-time"><span class="notification-time">4 mins ago</span></p>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </div>
          <div class="topnav-dropdown-footer">
              <a href="activities.html">View all Notifications</a>
          </div>
        </div>
      </li> -->
      <li class="nav-item dropdown">
          <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link pr-4 pl-4"><i class="fas fa-comment"></i> <span class="badge badge-pill bg-primary pull-right">8</span></a>
      </li>
      <li class="nav-item dropdown has-arrow">
        <a @click.prevent="toggleUserMenuOption($event)" :title="fullname" class="dropdown-toggle nav-link user-link mr-3 pr-5 pl-5" data-toggle="dropdown">
          <span class="user-img mr-2"><img class="rounded-circle" :src="loggedUser.photo" width="40" height="40" alt="">
							<span class="status online"></span>
          </span>
          <span><strong>{{initials}}</strong></span>
        </a>
        <div class="dropdown-menu" style="width: 100% !important">
          <router-link class="dropdown-item" :title="fullname" 
            :to="{
              name: 'LoggedUserProfileDetails',
              params: {
                loggedUserID: loggedUser.id,
                loggedUserRouteDetails: loggedUser.role.access_level
              }
            }"
          >
            <i class="fas fa-user-cog"></i> {{initials}}'s Profile
          </router-link>
          <router-link class="dropdown-item" 
            :to="{
              name: 'GeneralSettings',
              params: {
                loggedUserID: loggedUser.id,
                loggedUserRouteDetails: loggedUser.role.access_level
              }
            }"
          >
            <i class="fas fa-cogs"></i> Settings
          </router-link>
          <a class="dropdown-item" @click.prevent="attemptLoggingOutUser"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
      </li>
    </ul>
    <div class="dropdown mobile-user-menu pull-right">
        <a @click.prevent="toggleUserMenuOption($event)" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style=" padding: 5px 10px;"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right" style="width: 100% !important">
            <router-link class="dropdown-item" :title="fullname" 
            :to="{
              name: 'LoggedUserProfileDetails',
              params: {
                loggedUserID: loggedUser.id,
                loggedUserRouteDetails: loggedUser.role.access_level
              }
            }"
          >
            <i class="fas fa-user-cog"></i> {{initials}}'s Profile
          </router-link>
          <router-link class="dropdown-item"
            :to="{
              name: 'GeneralSettings',
              params: {
                loggedUserID: loggedUser.id,
                loggedUserRouteDetails: loggedUser.role.access_level
              }
            }"
          >
            <i class="fas fa-cogs"></i> Settings
          </router-link>
          <a class="dropdown-item" @click.prevent="attemptLoggingOutUser"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>
  </div>
</template>

<script>

  import { mapGetters } from "vuex";
  import { isEmptyObject } from '../../helpers/isEmptyObject';
  import { capitalizeWordsInPhrase, fullnameInitials } from '../../helpers/wordsHelper';
  import { MANAGER, TAILOR, LAUNDRY, FRONT_DESK, ATTEMPT_LOGOUT, ADD_ALERT_MESSAGE } from "../../store/store_helpers/constantVariables";

  import Notifications from './Notifications.vue'

  export default {
    name: 'LoggedUserPageHeader',
    components: {
      'notifications': Notifications
    },

    props: {
      pageHeader: {
        type: String,
        required: true
      }
    },

    data() {
      return {
        loggedUserDashboard: {},
        loggedUserProfile: {},
      }
    },

    computed: {
      ...mapGetters([ "isLoading", "loggedUser" ]),

      fullname() {
        return isEmptyObject(this.loggedUser) ? "" : capitalizeWordsInPhrase(`${this.loggedUser.lastname} ${this.loggedUser.othernames}`);
      },

      initials() {
        return fullnameInitials(this.fullname);
      }
    },

    methods: {
      getLoggedUserDashboard() {
        if (this.loggedUser.role.access_level === MANAGER) {
         return {
            name: 'ManagerUserAccountDashboard',
            params: {
              loggedUserID: this.loggedUser.id
            }
          }
        } else if (this.loggedUser.role.access_level === TAILOR) {
          return {
            name: 'TailorUserAccountDashboard',
            params: {
              loggedUserID: this.loggedUser.id
            }
          }
        } else if (this.loggedUser.role.access_level === FRONT_DESK) {
          return {
            name: 'ServiceUserAccountDashboard',
            params: {
              loggedUserID: this.loggedUser.id
            }
          }
        } else if (this.loggedUser.role.access_level === LAUNDRY) {
          return {
            name: 'LaundryUserAccountDashboard',
            params: {
              loggedUserID: this.loggedUser.id
            }
          }
        }
      },

      toggleMobileMenuOption() {
        if (document.querySelector(".main-wrapper").classList.contains('slide-nav')) {
          document.querySelector("html").classList.remove('menu-opened')
          document.querySelector(".main-wrapper").classList.remove('slide-nav')
          document.querySelector(".sidebar").classList.remove('opened')
          document.querySelector(".sidebar-overlay").classList.remove('opened')
        } else {
          document.querySelector("html").classList.add('menu-opened')
          document.querySelector(".main-wrapper").classList.add('slide-nav')
          document.querySelector(".sidebar").classList.add('opened')
          document.querySelector(".sidebar-overlay").classList.add('opened')
        }

        EventBus.$emit('mobile-menu-option-toggled')
      },

      toggleUserMenuOption(e) {
        let targetElement = this.getTargetElement(e);
        if (targetElement) {
            if (targetElement.classList.contains('dropdown-toggle')) {
                if (targetElement.nextElementSibling.classList.contains('show')) {
                    targetElement.nextElementSibling.classList.remove('show');
                } else {
                    targetElement.nextElementSibling.classList.add('show');
                }
            }
        }
      },

      getTargetElement(events) {
        if (events.target.tagName === "A") {
            return events.target;
        } else if (events.target.parentNode.tagName === "A") {
            return events.target.parentNode;
        } else if (events.target.parentNode.parentNode.tagName === "A") {
            return events.target.parentNode.parentNode;
        } else {
            return null;
        }
      },

      attemptLoggingOutUser() {
        if (confirm("Do you want to Logout?")) {
          this.$store.dispatch(ATTEMPT_LOGOUT)
            .then(() => {
              this.$router.push({
                name: 'ManagementLogin'
              })
            }).catch((error) => {
              this.$store.dispatch(ADD_ALERT_MESSAGE, { alertType: 'danger', message: "Unauthorize user request!!!" })
                .then(() => { console.log("Alert message update.");});
              console.log("LOGOUT ATTEMPT FAILED ERROR: ", error);
            });
        }
      }
    },

    created() {
      this.loggedUserDashboard = this.getLoggedUserDashboard();
    }
  }
</script>

<style lang="scss" scoped>
  @import url("../../../css/style.css");
  @import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css");

.header {background-color: #000000;left: 0;position: fixed;right: 0;top: 0;z-index: 1041;height: 60px;border-bottom: 1px solid #2d2d2d;}
.header .header-left {float: left;height: 70px;padding: 0 20px;position: relative;text-align: center;width: 250px !important;z-index: 1;background: transparent;}
.logo {display: block;line-height: 70px;}
.header .navbar-nav .badge {position: absolute;right: 7px;top: 4px;}
.header .dropdown-menu > li > a {position: relative;}
.header .dropdown-toggle::after {display: none;}
.header .has-arrow .dropdown-toggle::after {display: inline-block;}
.page-title-box {border-radius: 0;height: 70px;padding: 0px 20px; margin-left: 250px; display: flex; align-items: center;}
.page-title-box h3 {color: #d4af37;font-size: 20px;font-weight: normal;margin: 0;}
.user-menu {margin: 0;position:relative;z-index:99;	}
.user-menu.nav > li > a {color: #d4af37;font-size: 16px;line-height: 70px;padding: 0 15px;height: 70px;}
.user-menu.nav > li > a:hover, .user-menu.nav > li > a:focus {background-color:rgba(240, 240, 240, 0.2);}
.user-img {display: inline-block;position: relative;}
.user-img .status {border: 2px solid #fff;bottom: 0;height: 10px;position: absolute;right: 0;width: 10px;}
.user-menu .user-img .status {bottom: 10px;}
.user-menu .dropdown-menu {min-width: 136px;}
.user-menu .bg-primary {background-color:#00bf6f !important;}
.status {background-color: #ccc;border-radius: 50%;display: inline-block;height: 10px;width: 10px;}
.status.online {background-color: #55ce63;}
.status.offline {background-color: #f62d51;}
.status.away {background-color: #faa937;}

.mobile-user-menu {line-height: 70px;}
.mobile-user-menu > a {color:#d4af37;padding:0;z-index: 5000;}
.mobile-user-menu > a:hover {color:#fff;}
.mobile-user-menu > .dropdown-menu > a {line-height:23px;}


@media only screen and (max-width: 991.98px) {
	.header .header-left {position:absolute; width:100% !important; text-align: center;}
	.mobile_btn {display:block;}
	.page-title-box {display:none;}
	a.mobile_btn {
    color: #d4af37; cursor: pointer; font-size: 24px;height: 60px;left: 0;line-height: 70px;padding: 0 20px;position: absolute;top: 0;width: 60px;z-index: 5000;
  
    &:hover {color:#fff !important;}
  }
  body {font-size:13px;}

}
</style>