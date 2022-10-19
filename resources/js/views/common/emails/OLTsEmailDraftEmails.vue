<template>
  <div class="content">
    Email Draft
  </div>
</template>

<script>
  export default {
    name: 'OLTsEmailDraftEmails',

    data() {
      return {

      }
    },

    computed: {

    },

    methods: {
        
    },

    created() {
      EventBus.$emit('active-menu-label-updated', 'email draft');
    }
  }
</script>

<style lang="scss" scoped>
  .content {
    background: transparent;
  }
</style>