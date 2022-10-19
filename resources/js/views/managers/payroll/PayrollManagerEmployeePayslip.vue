<template>
  <div class="content">
    Employee Payslip
  </div>
</template>

<script>
  export default {
    name: 'PayrollManagerEmployeePayslip',

    data() {
      return {

      }
    },

    computed: {

    },

    methods: {
        
    },

    created() {
      EventBus.$emit('active-menu-label-updated', 'employee payslip');
    }
  }
</script>

<style lang="scss" scoped>
  .content {
    background: transparent;
  }
</style>