<template>
  <div class="content">
    SMS Templates
  </div>
</template>

<script>
  export default {
    name: 'OLTsSMSTemplateAllTemplates',

    data() {
      return {

      }
    },

    computed: {

    },

    methods: {
        
    },

    created() {
      EventBus.$emit('active-menu-label-updated', 'sms templates');
    }
  }
</script>

<style lang="scss" scoped>
  .content {
    background: transparent;
  }
</style>