<template>
  <div class="content">
    All
  </div>
</template>

<script>
  export default {
    name: 'All',

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