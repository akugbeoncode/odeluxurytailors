<template>
  <div class="content">
    Email Starred
  </div>
</template>

<script>
  export default {
    name: 'OLTsEmailStarredEmails',

    data() {
      return {

      }
    },

    computed: {

    },

    methods: {
        
    },

    created() {
      EventBus.$emit('active-menu-label-updated', 'starred email');
    }
  }
</script>

<style lang="scss" scoped>
  .content {
    background: transparent;
  }
</style>