<template>
  <div class="content container-fluid">
    <div class="row">
      <div class="col-12 mb-3">
        <div class="page-quick-menu">
          <router-link 
            :to="{
              name: 'LaundryUserRegisterNewTransaction',
              params: {
                loggedUserID: loggedUser.id
              }
            }" 
            class="menu-item mr-3"
          >
            <span class="mr-2"><i class="fas fa-file fa-2x"></i></span><span class="menu-item-label">New Transaction</span>
          </router-link>
          <router-link 
            :to="{
              name: 'LaundryUserRegisteredTransactions',
              params: {
                loggedUserID: loggedUser.id
              }
            }" 
            class="menu-item mr-3"
          >
            <span class="mr-2"><i class="fas fa-folder-open fa-2x"></i></span><span class="menu-item-label">Open Transaction</span>
          </router-link>
        </div>
      </div>
    </div>
    <div class="row bg-secondary">
      <div class="statistic-head-section mt-3 mb-3">
        <div class="head-item ml-3">
          <i class="fas fa-chart-line fa-4x text-white"></i>
        </div>
        <div class="head-item">
          <span class="h4 ml-4 text-success"><strong>Today's Stats</strong></span>
          <span class="ml-4 text-warning"><strong>{{today}}.</strong></span>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-md-4">
          <div class="dash-widget dash-widget5">
              <span class="dash-widget-icon bg-success"><i class="fa fa-money" aria-hidden="true"></i></span>
              <div class="dash-widget-info">
                  <h3>$998</h3>
                  <span>Revenue</span>
              </div>
          </div>
      </div>
      <div class="col-md-4">
          <div class="dash-widget dash-widget5">
              <span class="dash-widget-icon bg-info"><i class="fa fa-user-o" aria-hidden="true"></i></span>
              <div class="dash-widget-info">
                  <h3>1072</h3>
                  <span>Users</span>
              </div>
          </div>
      </div>
      <div class="col-md-4">
          <div class="dash-widget dash-widget5">
              <span class="dash-widget-icon bg-warning"><i class="fa fa-files-o"></i></span>
              <div class="dash-widget-info">
                  <h3>72</h3>
                  <span>Projects</span>
              </div>
          </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><strong>Recent Activities</strong></h5>
          <div class="card-text">
<div class="table-responsive">
        <table class="table table-striped custom-table datatable text-white">
            <thead>
                <tr class="text-white">
                    <th style="width:30%;">Name</th>
                    <th>Email</th>
                    <th>Company</th>
                    <th>Created Date</th>
                    <th>Role</th>
                    <th class="text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <a href="profile.html" class="avatar">D</a>
                        <h2><a href="profile.html">Daniel Porter <span>Admin</span></a></h2>
                    </td>
                    <td>danielporter@example.com</td>
                    <td>Preadmin</td>
                    <td>1 Jan 2013</td>
                    <td>
                        <span class="badge badge-danger-border">Admin</span>
                    </td>
                    <td class="text-right">
                        <div class="dropdown dropdown-action">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_user"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_user"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
</div>

          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapGetters } from "vuex";

  export default {
    name: 'LaundryUserAccountDashboard',

    data() {
      return {
        today: null
      }
    },

    computed: {
      ...mapGetters([ "loggedUser" ]),
    },

    methods: {
        
    },

    created() {
      this.today = new Date().toLocaleString('en', { day: 'numeric', month: 'short', year: 'numeric' });
      EventBus.$emit('active-menu-label-updated', 'dashboard');
    }
  }
</script>

<style lang="scss" scoped>
  .page-quick-menu {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-items: flex-start;

    .menu-item {
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-items: flex-start;
    }

    .menu-item-label {
      font-weight: 700;
      line-height: 16px;
    }

    a {
      color: #aaaaaa;

      &:hover {
        color: #d4af37;
      }
    }
  }

  .statistic-head-section {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-items: flex-start;

    .head-item {
      display: flex;
      flex-direction: column;
      // align-items: center;
      justify-items: flex-start;

      span {
        line-height: 16px;
      }
    }
  }

  .text-default { color: #d4af37; }
</style>