<template>
  <div class="content">
    Edit
  </div>
</template>

<script>
  export default {
    name: 'Edit',

    data() {
      return {

      }
    },

    computed: {

    },

    methods: {
        
    },

    created() {
      EventBus.$emit('active-menu-label-updated', 'edit');
    }
  }
</script>

<style lang="scss" scoped>
  .content {
    background: transparent;
  }
</style>