<template>
  <div class="content">
    All
  </div>
</template>

<script>

  import { mapGetters } from "vuex";

  export default {
    name: 'All',

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
      EventBus.$emit('active-menu-label-updated', 'all product variants');
    }
  }
</script>

<style lang="scss" scoped>
  .content {
    background: transparent;
  }
</style>