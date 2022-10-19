<template>
  <div class="content">
    Email Sent
  </div>
</template>

<script>
  export default {
    name: 'OLTsEmailSentEmails',

    data() {
      return {

      }
    },

    computed: {

    },

    methods: {
        
    },

    created() {
      EventBus.$emit('active-menu-label-updated', 'sent email');
    }
  }
</script>

<style lang="scss" scoped>
  .content {
    background: transparent;
  }
</style>