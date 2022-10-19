<template>
  <div class="content">
    Details
  </div>
</template>

<script>
  export default {
    name: 'Details',

    data() {
      return {

      }
    },

    computed: {

    },

    methods: {
        
    },

    created() {
      EventBus.$emit('active-menu-label-updated', 'details');
    }
  }
</script>

<style lang="scss" scoped>
  .content {
    background: transparent;
  }
</style>