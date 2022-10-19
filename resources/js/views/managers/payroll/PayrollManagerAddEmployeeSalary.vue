<template>
  <div class="content">
    Employee Salary
  </div>
</template>

<script>
  export default {
    name: 'PayrollManagerEmployeeSalary',

    data() {
      return {

      }
    },

    computed: {

    },

    methods: {
        
    },

    created() {
      EventBus.$emit('active-menu-label-updated', 'employee salary');
    }
  }
</script>

<style lang="scss" scoped>
  .content {
    background: transparent;
  }
</style>