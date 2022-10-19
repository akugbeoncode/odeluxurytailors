<template>
  <div class="content container-fluid">
    <div class="row">
        <div class="col-sm-4 col-4">
            <h4 class="page-title">Add Variant</h4>
        </div>
        <div class="col-sm-8 col-8 text-right m-b-30">
          <router-link 
            :to="{
              name: 'CategoryDetails',
              params: {
                loggedUserID: loggedUser.id
              }
            }" 
            class="btn btn-outline-danger"
          >
            <i class="fas fa-times"></i>
            Cancel
          </router-link>
        </div>
    </div>
  </div>
</template>

<script>
  import { mapGetters } from "vuex";

  export default {
    name: 'Add',

    data() {
      return {

      }
    },

    computed: {
      ...mapGetters([ 'isLoading', 'loggedUser', 'token', 'tokenType' ]),
    },

    methods: {
        
    },

    created() {
      EventBus.$emit('active-menu-label-updated', 'add');
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