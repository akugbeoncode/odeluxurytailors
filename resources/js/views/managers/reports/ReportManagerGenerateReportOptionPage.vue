<template>
  <div class="content">
    Generate Report Option Page
  </div>
</template>

<script>
  export default {
    name: 'ReportManagerGenerateReport',

    data() {
      return {

      }
    },

    computed: {

    },

    methods: {
        
    },

    created() {
      EventBus.$emit('active-menu-label-updated', 'generate report options');
    }
  }
</script>

<style lang="scss" scoped>
  .content {
    background: transparent;
  }
</style>