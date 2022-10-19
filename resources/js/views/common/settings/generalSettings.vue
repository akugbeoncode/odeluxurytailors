<template>
  <div class="content">
    <div class="row">
      <div class="col-sm-7 col-4">
        <h4 class="page-title">General Settings</h4>
      </div>

      <div class="col-sm-5 col-8 text-right m-b-30">
        
      </div>
    </div>
    <div class="card-box">
        <div class="row">
            <div class="col-md-12">
                <h3>General Settings</h3>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
  import { mapGetters } from "vuex";

  import { IS_LOADING } from "../../../store/store_helpers/constantVariables";

  import { capitalizeWordsInPhrase, fullnameInitials } from '../../../helpers/wordsHelper';

  import { isEmptyObject } from '../../../helpers/isEmptyObject';
  import { processDate } from '../../../helpers/processDateTime';

  export default {
    name: 'LoggedUserChangeProfilePassword',

    data() {
      return {
       
      }
    },

    computed: {
      ...mapGetters([ 'isLoading', 'loggedUser', 'token', 'tokenType' ]),
    },

    methods: {
      capitalizeWordsInPhrase(word) {
        return capitalizeWordsInPhrase(word);
      },
      
      fullnameInitials(fulname) {
        return fullnameInitials(fulname);
      },

      isEmptyObject(obj) {
        return isEmptyObject(obj);
      },

      processDateDOB(dateInfo) {
        const dateInstance = processDate(dateInfo);
        return dateInstance.split(',')[0];
      }
    },

    created() {
      EventBus.$emit('active-menu-label-updated', 'change logged user password');
    }
  }
</script>

<style lang="scss" scoped>
  .content {
    background: transparent;
  }

  .page-title {
    color: #d4af37;
  }
</style>