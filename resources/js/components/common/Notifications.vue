<template>
    <b-nav-item-dropdown right class="right-dropdown mr-3">
      <template #button-content>
         <b-icon icon="bell-fill" aria-hidden="true"></b-icon>
      </template>
      <b-dropdown-item href="#">Profile</b-dropdown-item>
      <b-dropdown-item href="#">Sign Out</b-dropdown-item>
    </b-nav-item-dropdown>
</template>

<script>
  import { BIcon } from 'bootstrap-vue';

  export default {
    name: "Notifications",
    components: {
      'b-icon': BIcon
    }
  }
</script>

<style lang="scss" scoped>
  .transparent {
    background: transparent !important;
  }
</style>