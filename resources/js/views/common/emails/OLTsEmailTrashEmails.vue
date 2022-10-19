<template>
  <div class="content">
    Email Trash
  </div>
</template>

<script>
  export default {
    name: 'OLTsEmailTrashEmails',

    data() {
      return {

      }
    },

    computed: {

    },

    methods: {
        
    },

    created() {
      EventBus.$emit('active-menu-label-updated', 'trashed email');
    }
  }
</script>

<style lang="scss" scoped>
  .content {
    background: transparent;
  }
</style>