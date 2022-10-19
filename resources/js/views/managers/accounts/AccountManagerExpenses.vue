<template>
  <div class="content container-fluid">
    <div class="row">
        <div class="col-sm-4 col-4">
            <h4 class="page-title">Expenses</h4>
        </div>
        <div class="col-sm-8 col-8 text-right m-b-30">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus"></i>Add Expense</a>
        </div>
    </div>
    <div class="row filter-row">
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus focused">
                <label class="focus-label">Transaction ID</label>
                <input type="text" class="form-control floating">
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus focused">
                <label class="focus-label">Client ID</label>
                <input type="text" class="form-control floating">
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus focused">
                <label class="focus-label">Transaction Date</label>
                <input type="date" class="form-control floating">
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <a href="#" class="btn btn-success btn-block"> Search </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
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
</template>

<script>
  export default {
    name: 'AccountManagerExpenses',

    data() {
      return {

      }
    },

    computed: {

    },

    methods: {
        
    },

    created() {
      EventBus.$emit('active-menu-label-updated', 'expenses');
    }
  }
</script>

<style lang="scss" scoped>
  .content {
    background: transparent;
  }
  
  .page-title {
    color: #d4af37;
  }
</style>