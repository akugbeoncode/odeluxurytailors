<template>
  <div>
    <div class="main-wrapper">
      <page-header class="header" :pageHeader="pageHeaderLabel"></page-header>
      <page-sidemenu class="sidebar" :class="{ 'opened-menu-window': showMobileMenuOption }"></page-sidemenu>
      <div class="page-wrapper" :class="{ 'strink-page-wrapper': showMobileMenuOption }">
        <router-view></router-view>
      </div>
      <div 
        v-for="(alert, index) in alertMessages"
        :key="index"
        class="message-alerts"
      >
        <message-alert :alertType="alert.alertType" :message="alert.message" :targetIndex="index"></message-alert>
      </div>
    </div>
    <div class="sidebar-overlay" data-reff="#sidebar"></div>
  </div>
</template>

<script>
  import { mapGetters } from "vuex";

  import PageHeader from '../../components/common/LoggedUserPageHeader.vue';
  import PageSideMenu from '../../components/common/LoggedUserProfileSideMenu.vue';
  import MesaageAlert from '../alerts/AlertRoot.vue';

  import { MANAGER, TAILOR, LAUNDRY, FRONT_DESK } from "../../store/store_helpers/constantVariables";

  import { isEmptyObject } from '../../helpers/isEmptyObject';

  export default {
    name: 'ApplicationProfileRoot',
    components: {
      "page-header": PageHeader,
      "page-sidemenu": PageSideMenu,
      "message-alert": MesaageAlert   
    },

    data() {
        return {
          showMobileMenuOption: false,
          pageHeaderLabel: ''
        }
    },

    computed: {
      ...mapGetters([ "loggedUser", "alertMessages" ]),
    },

    methods: {
      toggleMobileMenuOption() {
        this.showMobileMenuOption = !this.showMobileMenuOption
      },

      getPageHeaderLabel() {
        if (this.loggedUser.role.access_level === MANAGER) {
         return 'Manager';
        } else if (this.loggedUser.role.access_level === TAILOR) {
          return 'Tailor';
        } else if (this.loggedUser.role.access_level === FRONT_DESK) {
          return 'Front Desk Services (Fashion)';
        } else if (this.loggedUser.role.access_level === LAUNDRY) {
          return 'Front Desk Services (Laundry)';
        }
      }
    },

    mounted() {
      EventBus.$on('mobile-menu-option-toggled', this.toggleMobileMenuOption)
    },

    created() {
      this.pageHeaderLabel = this.getPageHeaderLabel();
    }
  }
</script>

<style lang="scss" scoped>
  .main-wrapper {
    width: 100% !important;
    height: 100% !important;
    overflow-x: hidden !important;

    .header {
      left: 0;
      position: fixed;
      right: 0;
      top: 0;
      z-index: 1041;
      height: 70px;
      border-bottom: 1px solid #2d2d2d;
    }

    .sidebar {
      top:70px;
      width:250px !important;
      z-index:1041;
      background-color: #000000;
      bottom:0;
      margin-top:0px;
      position:fixed;
      left:0;
      -webkit-transition: all 0.4s ease;
      -moz-transition: all 0.4s ease; 
      transition: all 0.4s ease;
      border-right: 1px solid #2d2d2d;

      overflow-x: hidden !important;
      overflow-y: auto !important;
    }

    .message-alerts {
      position: fixed;
      top: 80px;
      right: 20px;
      width:300px !important;
      height: calc(100vh - 70px);
      z-index: 100000;

      -webkit-transition: all 0.4s ease;
      -moz-transition: all 0.4s ease;
      transition: all 0.4s ease;
    }

    .message-alerts {
      position: fixed;
      top: 80px;
      right: 20px;
      width:300px !important;
      height: calc(100vh - 70px);
      z-index: 100000;

      -webkit-transition: all 0.4s ease;
      -moz-transition: all 0.4s ease;
      transition: all 0.4s ease;
    }

    .page-wrapper {
      left: 0;
      margin-left: 250px !important;
      padding-top: 70px;
      position: relative;
      -webkit-transition: all 0.4s ease;
      -moz-transition: all 0.4s ease;
      transition: all 0.4s ease;

      width: calc(100% - 250px) !important;
    }

    .page-wrapper > .content{padding:30px;}

    @media only screen and (max-width: 991.98px) {
      .page-wrapper {margin-left: 0 !important;padding-left: 0 !important;padding-right: 0 !important; width: 100% !important;}
      .sidebar {margin-left: -255px;width: 255px;}
      .sidebar {margin-left: -255px;width: 255px;}
      body {font-size:13px;}

      .opened-menu-window { margin-left: 0 !important; }
      .strink-page-wrapper { left: 255px !important;margin-left: 0 !important;}

      .page-wrapper > .content{padding:15px;}
    }
  }
 
</style>
