<template>
  <div class="content">
    Invoices
  </div>
</template>

<script>
  export default {
    name: 'AccountManagerInvoices',

    data() {
      return {

      }
    },

    computed: {

    },

    methods: {
        
    },

    created() {
      EventBus.$emit('active-menu-label-updated', 'invoices');
    }
  }
</script>

<style lang="scss" scoped>
  .content {
    background: transparent;
  }
</style>