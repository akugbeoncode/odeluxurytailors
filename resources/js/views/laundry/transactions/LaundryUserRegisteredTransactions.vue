<template>
  <div class="content container-fluid">
    <div class="row">
      <div class="col-sm-4 col-4">
        <h4 class="page-title">Transactions</h4>
      </div>
      <div class="col-sm-8 col-8 text-right m-b-30">
        <router-link 
          :to="{
            name: 'LaundryUserAccountDashboard',
            params: {
              loggedUserID: loggedUser.id
            }
          }" 
          class="btn btn-outline-danger"
        ><i class="fas fa-arrow-circle-left mr-2"></i> Back</router-link>
      </div>
    </div>
    <div class="row">
        
    </div>
    <div class="row">
        
  
    </div>
  </div>
</template>

<script>
  import { mapGetters } from "vuex";

  export default {
    name: 'LaundryUserRegisteredTransactions',

    data() {
      return {

      }
    },

    computed: {
      ...mapGetters([ "loggedUser" ]),
    },

    methods: {
        
    },

    created() {
      EventBus.$emit('active-menu-label-updated', '');
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