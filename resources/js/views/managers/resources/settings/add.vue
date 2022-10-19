<template>
  <div class="content">
    Add
  </div>
</template>

<script>
  export default {
    name: 'Add',

    data() {
      return {

      }
    },

    computed: {

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
</style>