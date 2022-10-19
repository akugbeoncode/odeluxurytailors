<template>
  <div>
    <div class="sidebar-inner slimscroll">
      <div id="sidebar-menu" class="sidebar-menu">
        <ul>
          <li class="menu-title">Main</li>
          <li :class="{ active: activeLinkLabel  === 'dashboard' }">
            <router-link
              :to="{
                name: 'ManagerUserAccountDashboard',
                params: {
                  loggedUserID: loggedUserID
                }
              }"
            >
              <i class="fas fa-house-user"></i> Dashboard
            </router-link>
          </li>

           <li :class="{ active: activeLinkLabel  === 'chat' }">
            <router-link
              :to="{
                name: 'ChatManagerApplication',
                params: {
                  loggedUserID: loggedUserID,
                  loggedUserRouteDetails: loggedUser.role.access_level,
                  recipientID: 'euurueii-jjjjdjdjd-3536dhjxn-ndmmdkdmk47838292'
                }
              }"
            >
              <i class="fas fa-comments"></i> Chat
            </router-link>
          </li>

          <li :class="{ active: activeLinkLabel  === 'email' }">
            <router-link
              :to="{
                name: 'OLTsEmailInboxEmails',
                params: {
                  loggedUserID: loggedUserID,
                  loggedUserRouteDetails: loggedUser.role.access_level
                }
              }"
            >
              <i class="fas fa-envelope"></i> Email
            </router-link>
          </li>

          <li class="submenu">
            <a @click.prevent="toggleSubmenu($event)"><i class="fas fa-sitemap"></i> <span> Product Manager</span> <span class="menu-arrow"></span></a>
            <ul class="list-unstyled" style="display: none;">
              <li :class="{ active: activeLinkLabel  === 'all products' }">
                <router-link
                  :to="{
                    name: 'AllProducts',
                    params: {
                      loggedUserID: loggedUserID
                    }
                  }"
                >
                  Products
                </router-link>
              </li>

              <!-- <li :class="{ active: activeLinkLabel  === 'all product variants' }">
                <router-link
                  :to="{
                    name: 'AllProductVariants',
                    params: {
                      loggedUserID: loggedUserID
                    }
                  }"
                >
                  Product Variants
                </router-link>
              </li> -->
            </ul>
          </li>

          <li class="submenu">
            <a @click.prevent="toggleSubmenu($event)"><i class="fas fa-layer-group"></i> <span> Resources</span> <span class="menu-arrow"></span></a>
            <ul class="list-unstyled" style="display: none;">
              <li :class="{ active: activeLinkLabel  === 'generate report options' }">
                <router-link
                  :to="{
                    name: 'AllBrands',
                    params: {
                      loggedUserID: loggedUserID
                    }
                  }"
                >
                  Brands
                </router-link>
              </li>

              <li :class="{ active: activeLinkLabel  === 'generate report options' }">
                <router-link
                  :to="{
                    name: 'AllCategories',
                    params: {
                      loggedUserID: loggedUserID
                    }
                  }"
                >
                  Categories
                </router-link>
              </li>

              <li :class="{ active: activeLinkLabel  === 'generate report options' }">
                <router-link
                  :to="{
                    name: 'ProductUnits',
                    params: {
                      loggedUserID: loggedUserID
                    }
                  }"
                >
                  Units
                </router-link>
              </li>

              <li :class="{ active: activeLinkLabel  === 'generate report options' }">
                <router-link
                  :to="{
                    name: 'AllSettings',
                    params: {
                      loggedUserID: loggedUserID
                    }
                  }"
                >
                  Settings
                </router-link>
              </li>

            </ul>
          </li>

          <li class="submenu">
            <a @click.prevent="toggleSubmenu($event)"><i class="fas fa-money-check-alt"></i> <span> Transactions</span> <span class="menu-arrow"></span></a>
            <ul class="list-unstyled" style="display: none;">
              <li :class="{ active: activeLinkLabel  === 'fashion transactions' }">
                <router-link
                  :to="{
                    name: 'TransactionManagerFashionBusinessAllTransactions',
                    params: {
                      loggedUserID: loggedUserID
                    }
                  }"
                >
                  Fashion
                </router-link>
              </li>

               <li :class="{ active: activeLinkLabel  === 'laundry transactions' }">
                <router-link
                  :to="{
                    name: 'TransactionManagerLaundryBusinessAllTransactions',
                    params: {
                      loggedUserID: loggedUserID
                    }
                  }"
                >
                  Laundry
                </router-link>
              </li>
            </ul>
          </li>

          <li class="submenu">
            <a @click.prevent="toggleSubmenu($event)"><i class="fas fa-tasks"></i> <span> Tasks</span> <span class="menu-arrow"></span></a>
            <ul class="list-unstyled" style="display: none;">
              <li :class="{ active: activeLinkLabel  === 'all tasks' }">
                <router-link
                  :to="{
                    name: 'TaskManagerAllTasks',
                    params: {
                      loggedUserID: loggedUserID
                    }
                  }"
                >
                  All
                </router-link>
              </li>
            </ul>
          </li>

          <li class="submenu">
            <a @click.prevent="toggleSubmenu($event)"><i class="fas fa-dolly-flatbed"></i> <span> Inventory Manager</span> <span class="menu-arrow"></span></a>
            <ul class="list-unstyled" style="display: none;">
              <li :class="{ active: activeLinkLabel  === 'inventory items' }">
                <router-link
                  :to="{
                    name: 'InventoryManangerAllItems',
                    params: {
                      loggedUserID: loggedUserID
                    }
                  }"
                >
                  All Items
                </router-link>
              </li>
            </ul>
          </li>

          <li class="submenu">
            <a @click.prevent="toggleSubmenu($event)"><i class="fas fa-users"></i> <span> Employees</span> <span class="menu-arrow"></span></a>
            <ul class="list-unstyled" style="display: none;">
              <li :class="{ active: activeLinkLabel  === 'employees' }">
                <router-link
                  :to="{
                    name: 'EmployeeManagerViewAllEmployees',
                    params: {
                      loggedUserID: loggedUserID
                    },
                    query: {
                      role: ''
                    }
                  }"
                >
                  All
                </router-link>
              </li>
              <li :class="{ active: activeLinkLabel  === 'executives' }">
                <router-link
                  :to="{
                    name: 'EmployeeManagerViewAllEmployees',
                    params: {
                      loggedUserID: loggedUserID
                    },
                    query: {
                      role: 'Executive'
                    }
                  }"
                >
                  Executives
                </router-link>
              </li>
              <li :class="{ active: activeLinkLabel  === 'managers' }">
                <router-link
                  :to="{
                    name: 'EmployeeManagerViewAllEmployees',
                    params: {
                      loggedUserID: loggedUserID
                    },
                    query: {
                      role: 'Manager'
                    }
                  }"
                >
                  Managers
                </router-link>
              </li>
              <li :class="{ active: activeLinkLabel  === 'tailors' }">
                <router-link
                  :to="{
                    name: 'EmployeeManagerViewAllEmployees',
                    params: {
                      loggedUserID: loggedUserID
                    },
                    query: {
                      role: 'Tailor'
                    }
                  }"
                >
                  Tailors
                </router-link>
              </li>
              <li :class="{ active: activeLinkLabel  === 'receptionists' }">
                <router-link
                  :to="{
                    name: 'EmployeeManagerViewAllEmployees',
                    params: {
                      loggedUserID: loggedUserID
                    },
                    query: {
                      role: 'Receptionist'
                    }
                  }"
                >
                  Receptionists
                </router-link>
              </li>
              <li :class="{ active: activeLinkLabel  === 'launderers' }">
                <router-link
                  :to="{
                    name: 'EmployeeManagerViewAllEmployees',
                    params: {
                      loggedUserID: loggedUserID
                    },
                    query: {
                      role: 'Launderer'
                    }
                  }"
                >
                  Launderers
                </router-link>
              </li>
            </ul>
          </li>

          <li class="submenu">
            <a @click.prevent="toggleSubmenu($event)"><i class="fas fa-hand-holding-usd"></i> <span> Payroll</span> <span class="menu-arrow"></span></a>
            <ul class="list-unstyled" style="display: none;">
              <li :class="{ active: activeLinkLabel  === 'employee salary' }">
                <router-link
                  :to="{
                    name: 'PayrollManagerEmployeeSalaries',
                    params: {
                      loggedUserID: loggedUserID
                    }
                  }"
                >
                  Employee Salaries
                </router-link>
              </li>
            </ul>
          </li>

          <li class="submenu">
            <a @click.prevent="toggleSubmenu($event)"><i class="fas fa-file-invoice"></i> <span> Accounts</span> <span class="menu-arrow"></span></a>
            <ul class="list-unstyled" style="display: none;">
              <li :class="{ active: activeLinkLabel  === 'expenses' }">
                <router-link
                  :to="{
                    name: 'AccountManagerExpenses',
                    params: {
                      loggedUserID: loggedUserID
                    }
                  }"
                >
                  Expenses
                </router-link>
              </li>

              <li :class="{ active: activeLinkLabel  === 'invoices' }">
                <router-link
                  :to="{
                    name: 'AccountManagerInvoices',
                    params: {
                      loggedUserID: loggedUserID
                    }
                  }"
                >
                  Invoices
                </router-link>
              </li>
            </ul>
          </li>

          <li class="submenu">
            <a @click.prevent="toggleSubmenu($event)"><i class="fas fa-flag"></i> <span> Generate Reports</span> <span class="menu-arrow"></span></a>
            <ul class="list-unstyled" style="display: none;">
              <li :class="{ active: activeLinkLabel  === 'generate report options' }">
                <router-link
                  :to="{
                    name: 'ReportManagerGenerateReportOptionPage',
                    params: {
                      loggedUserID: loggedUserID
                    }
                  }"
                >
                  Options
                </router-link>
              </li>
            </ul>
          </li>

        </ul>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapGetters } from "vuex";

  export default {
    name: 'LoggedUserSideMenu',

    data() {
      return {
        loggedUserID: "",
        activeLinkLabel: "dashboard"
      }
    },

    computed: {
      ...mapGetters([ "loggedUser" ]),
    },

    methods: {
      toggleSubmenu(event) {
        let targetElement = this.getTargetElement(event);

        if (targetElement.parentNode.classList.contains('submenu')) {
          if (targetElement.classList.contains('subdrop')) {
            targetElement.classList.remove('subdrop');
            targetElement.nextElementSibling.style.display = "none"; 
          } else {
            targetElement.classList.add('subdrop');
            targetElement.nextElementSibling.style.display = "block"; 
          }
        }
      },

      getTargetElement(e) {
        if (e.target.tagName === "A") {
          return e.target;
        } else if (e.target.parentNode.tagName === "A") {
          return e.target.parentNode;
        } else if (e.target.parentNode.parentNode.tagName === "A") {
          return e.target.parentNode.parentNode;
        } else {
          return null;
        }
      },

      updateActiveMenuLabel(labelUpdate) {
        this.activeLinkLabel = labelUpdate;
      }
    },

    created() {
      this.loggedUserID = this.$route.params.loggedUserID

      EventBus.$on('active-menu-label-updated', this.updateActiveMenuLabel);
    }
  }
</script>

<style lang="scss" scoped>
  @import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");

  .sidebar-inner{
    height:100%;

    .sidebar-menu ul {font-size: 15px;list-style-type: none;margin: 0;padding: 0;position:relative;}
    .sidebar-menu li a {color: #d4af37;display: block;font-size: 14px;height: auto;line-height: 40px;min-height: 40px;padding: 0 20px; font-weight: 700;}
    .sidebar-menu li a:hover {color:#00bf6f; text-decoration: none;}
    .sidebar-menu li a > .badge {margin-top: 10px;color: #fff;font-weight: 700;}
    .sidebar-menu li a i {font-size: 16px;margin-left: 10px;margin-right: 10px;}
    .sidebar-menu li a i.back-icon {margin-left:0;}
    .sidebar-menu li.active a {color: #00bf6f;background-color: transparent;}
    .menu-title {color: #d4af37;font-size: 15px;font-weight: 900;line-height: 40px;min-height: 40px;padding: 0 20px;text-transform: uppercase;}
    .menu-title > i {float: right;line-height: 40px;}
    .sidebar-menu li.menu-title a {color: #00bf6f;display: inline-block;float: right;padding: 0;}
    .sidebar-menu li.menu-title a.add-user-icon {background-color: #444;border-radius: 24px;color: #bbb;line-height: 24px;min-height: 24px;width: 24px;text-align: center;margin-top: 6px;}
    .sidebar-menu li.menu-title a.add-user-icon:hover {background-color: #00bf6f;color:#fff; text-decoration: none;}
    .sidebar-menu li.menu-title a.add-user-icon i {font-size: 15px;margin-left: 0;margin-right: 0;}
    .sidebar-menu li.menu-title a.btn {color: #fff;display: block;float: none;font-size: 15px;line-height: inherit;margin-bottom: 15px;}
    .sidebar-menu li.menu-title a.btn:hover {color:#fff; text-decoration: none;}
    .sidebar-menu ul ul a.active {color: #00bf6f;text-decoration: underline;}
    .mobile-user-menu {color: #fff;display: none;font-size: 24px;height: 60px;line-height: 60px;padding: 0 20px;position: absolute;right: 0;text-align: right;top: 0;width: 60px;z-index: 10;}
    .mobile-user-menu > a {color:#5c5c5c;padding:0;}
    .mobile-user-menu > a:hover {color:#333; text-decoration: none;}
    .mobile-user-menu > .dropdown-menu > a {line-height:23px;}
    .profile-rightbar {display:none !important;color: #00bf6f;font-size: 26px;margin-left: 15px;}
    .mobile_btn {display:none;}
    #sidebar-menu ul ul a {display: block;padding: 0 20px 0 50px;}
    #sidebar-menu ul ul ul a {padding-left: 80px;}
    #sidebar-menu ul ul ul ul a {padding-left: 100px;}
    #sidebar-menu ul ul {background-color: #111;}
    #sidebar-menu ul ul li:nth-child(even) {background: #222;}
    .sidebar-menu > ul > li {position: relative;}
    .sidebar-menu .menu-arrow {
      -webkit-transition: -webkit-transform 0.15s;
      -o-transition: -o-transform 0.15s;
      transition: transform .15s;
      position: absolute;
      right: 20px;
      display: inline-block;
      font-family: 'FontAwesome';
      text-rendering: auto;
      line-height: 40px;
      font-size: 18px;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      -webkit-transform: translate(0, 0);
      -ms-transform: translate(0, 0);
      -o-transform: translate(0, 0);
      transform: translate(0, 0);
    }
    .sidebar-menu .menu-arrow:before {content: "\f105" !important;}
    .sidebar-menu li a.subdrop .menu-arrow {-ms-transform: rotate(90deg); -webkit-transform: rotate(90deg); -o-transform: rotate(90deg); transform: rotate(90deg);}
    .noti-dot:before {content: '';width: 5px;height: 5px;border: 5px solid #00bf6f ;-webkit-border-radius: 30px;-moz-border-radius: 30px;border-radius: 30px;background-color: #00bf6f ;z-index: 10;position: absolute;right: 37px;top: 17px;}
    .noti-dot:after {
      content: '';
      border: 4px solid #00bf6f ;
      background: transparent;
      -webkit-border-radius: 60px;
      -moz-border-radius: 60px;
      border-radius: 60px;
      height: 24px;
      width: 24px;
      -webkit-animation: pulse 3s ease-out;
      -moz-animation: pulse 3s ease-out;
      animation: pulse 3s ease-out;
      -webkit-animation-iteration-count: infinite;
      -moz-animation-iteration-count: infinite;
      animation-iteration-count: infinite;
      position: absolute;
      top: 10px;
      right: 30px;
      z-index: 1;
      opacity: 0;
    }


    @media only screen and (max-width: 991.98px) {
      .sidebar {margin-left: -255px !important;width: 255px !important;}
      .sidebar-menu li a {font-size:13px;}
      .slide-nav .sidebar {margin-left: 0 !important;}
      body {font-size:13px;}
    }

    .sidebar-menu { margin-bottom: 200px; }
  }
</style>