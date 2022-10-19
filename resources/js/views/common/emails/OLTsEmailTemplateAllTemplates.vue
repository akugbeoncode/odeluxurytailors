<template>
  <div class="content">
    Email Templates
  </div>
</template>

<script>
  export default {
    name: 'OLTsEmailTemplateAllTemplates',

    data() {
      return {

      }
    },

    computed: {

    },

    methods: {
        
    },

    created() {
      EventBus.$emit('active-menu-label-updated', 'email templates');
    }
  }
</script>

<style lang="scss" scoped>
  .content {
    background: transparent;
  }
</style>